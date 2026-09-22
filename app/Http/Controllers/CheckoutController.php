<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (count($cart) === 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $total = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']);
        $requiresPrescription = collect($cart)->contains(fn ($item) => $item['requires_prescription']);

        return view('customer.checkout', compact('cart', 'total', 'requiresPrescription'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (count($cart) === 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $requiresPrescription = collect($cart)->contains(fn ($item) => $item['requires_prescription']);

        $rules = [
            'delivery_address' => 'required|string|max:500',
            'phone' => 'required|string|max:20',
        ];

        if ($requiresPrescription) {
            $rules['prescription'] = 'required|image|mimes:jpg,jpeg,png,pdf|max:5120';
        }

        $validated = $request->validate($rules);

        // Re-check stock before confirming (in case it changed since adding to cart)
        foreach ($cart as $medicineId => $item) {
            $medicine = Medicine::find($medicineId);
            if (!$medicine || $medicine->stock_quantity < $item['quantity']) {
                return redirect()->route('cart.index')
                    ->with('error', 'Sorry, "' . $item['name'] . '" no longer has enough stock. Please update your cart.');
            }
        }

        DB::beginTransaction();

        try {
            $prescriptionId = null;

            if ($requiresPrescription && $request->hasFile('prescription')) {
                $path = $request->file('prescription')->store('prescriptions', 'public');

                $prescription = Prescription::create([
                    'user_id' => Auth::id(),
                    'image_path' => $path,
                    'status' => 'pending',
                ]);

                $prescriptionId = $prescription->id;
            }

            $order = Order::create([
                'user_id' => Auth::id(),
                'prescription_id' => $prescriptionId,
                'total_amount' => collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']),
                'status' => 'pending',
                'delivery_address' => $validated['delivery_address'],
                'phone' => $validated['phone'],
            ]);

            foreach ($cart as $medicineId => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'medicine_id' => $medicineId,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);

                // Reduce stock in real time
                Medicine::where('id', $medicineId)->decrement('stock_quantity', $item['quantity']);
            }

            DB::commit();

            session()->forget('cart');

            return redirect()->route('orders.show', $order)->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('checkout.index')->with('error', 'Something went wrong. Please try again.');
        }
    }
}