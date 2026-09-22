<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Medicine $medicine)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$medicine->id])) {
            $cart[$medicine->id]['quantity']++;
        } else {
            $cart[$medicine->id] = [
                'name' => $medicine->name,
                'price' => $medicine->price,
                'quantity' => 1,
                'requires_prescription' => $medicine->requires_prescription,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', $medicine->name . ' added to cart.');
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']);

        return view('customer.cart', compact('cart', 'total'));
    }

    public function update(Request $request, $medicineId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$medicineId])) {
            $quantity = max(1, (int) $request->quantity);
            $cart[$medicineId]['quantity'] = $quantity;
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Cart updated.');
    }

    public function remove($medicineId)
    {
        $cart = session()->get('cart', []);
        unset($cart[$medicineId]);
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Item removed.');
    }
}