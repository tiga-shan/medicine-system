<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use App\Models\Order;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMedicines = Medicine::count();
        $lowStockCount = Medicine::whereColumn('stock_quantity', '<=', 'reorder_level')->count();
        $expiringSoonCount = Medicine::whereDate('expiry_date', '<=', Carbon::now()->addDays(30))->count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalOrders = Order::count();

        return view('admin.dashboard', compact(
            'totalMedicines',
            'lowStockCount',
            'expiringSoonCount',
            'pendingOrders',
            'totalOrders'
        ));
    }
}