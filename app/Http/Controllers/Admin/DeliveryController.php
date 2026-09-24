<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\Order;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index()
    {
        $orders = Order::with('delivery', 'user')
            ->whereIn('status', ['approved', 'packed', 'out_for_delivery', 'delivered'])
            ->latest()
            ->paginate(15);

        return view('admin.deliveries.index', compact('orders'));
    }

    public function assign(Request $request, Order $order)
    {
        $validated = $request->validate([
            'delivery_person' => 'required|string|max:255',
            'delivery_phone' => 'required|string|max:20',
        ]);

        Delivery::updateOrCreate(
            ['order_id' => $order->id],
            [
                'delivery_person' => $validated['delivery_person'],
                'delivery_phone' => $validated['delivery_phone'],
                'status' => 'assigned',
            ]
        );

        $order->update(['status' => 'packed']);

        return redirect()->back()->with('success', 'Delivery assigned for Order #' . $order->id);
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'delivery_status' => 'required|in:assigned,picked_up,in_transit,delivered',
        ]);

        $order->delivery->update([
            'status' => $validated['delivery_status'],
            'delivered_at' => $validated['delivery_status'] === 'delivered' ? now() : null,
        ]);

        // Keep order status in sync with delivery status
        $orderStatusMap = [
            'assigned' => 'packed',
            'picked_up' => 'out_for_delivery',
            'in_transit' => 'out_for_delivery',
            'delivered' => 'delivered',
        ];
        $order->update(['status' => $orderStatusMap[$validated['delivery_status']]]);

        return redirect()->back()->with('success', 'Delivery status updated.');
    }
}