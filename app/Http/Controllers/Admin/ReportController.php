<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $from = $request->filled('from') ? Carbon::parse($request->from) : Carbon::now()->subDays(30);
        $to = $request->filled('to') ? Carbon::parse($request->to)->endOfDay() : Carbon::now()->endOfDay();

        $totalSales = Order::whereBetween('created_at', [$from, $to])
            ->where('status', '!=', 'cancelled')
            ->sum('total_amount');

        $totalOrders = Order::whereBetween('created_at', [$from, $to])
            ->where('status', '!=', 'cancelled')
            ->count();

        $topMedicines = OrderItem::selectRaw('medicine_id, SUM(quantity) as total_sold, SUM(price * quantity) as total_revenue')
            ->whereHas('order', function ($q) use ($from, $to) {
                $q->whereBetween('created_at', [$from, $to])->where('status', '!=', 'cancelled');
            })
            ->with('medicine')
            ->groupBy('medicine_id')
            ->orderByDesc('total_sold')
            ->limit(10)
            ->get();

        $lowStockMedicines = Medicine::whereColumn('stock_quantity', '<=', 'reorder_level')->get();
        $expiringMedicines = Medicine::whereDate('expiry_date', '<=', Carbon::now()->addDays(30))->get();

        return view('admin.reports.index', compact(
            'totalSales', 'totalOrders', 'topMedicines',
            'lowStockMedicines', 'expiringMedicines', 'from', 'to'
        ));
    }
}