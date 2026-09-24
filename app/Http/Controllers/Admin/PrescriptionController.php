<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function index(Request $request)
    {
        $query = Prescription::with('user');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        } else {
            $query->where('status', 'pending');
        }

        $prescriptions = $query->latest()->paginate(10)->withQueryString();

        return view('admin.prescriptions.index', compact('prescriptions'));
    }

    public function updateStatus(Request $request, Prescription $prescription)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'admin_notes' => 'nullable|string|max:500',
        ]);

        $prescription->update($validated);

        // If prescription is rejected, also cancel the linked order(s)
        if ($validated['status'] === 'rejected') {
            $prescription->orders()->where('status', 'pending')->update(['status' => 'cancelled']);
        }

        return redirect()->route('admin.prescriptions.index')->with('success', 'Prescription ' . $validated['status'] . '.');
    }
}