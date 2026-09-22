<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Medicine::where('stock_quantity', '>', 0);

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('generic_name', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $medicines = $query->latest()->paginate(9)->withQueryString();
        $categories = Medicine::whereNotNull('category')->distinct()->pluck('category');

        return view('customer.shop', compact('medicines', 'categories'));
    }
}