<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Prescriptions</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">

                @if (session('success'))
                    <div class="mb-4 p-4 bg-teal-50 text-teal-700 rounded-lg border border-teal-100">{{ session('success') }}</div>
                @endif

                <form method="GET" class="mb-5">
                    <select name="status" onchange="this.form.submit()" class="border-slate-200 rounded-lg px-4 py-2">
                        <option value="pending" {{ request('status', 'pending') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </form>

                <div class="space-y-4">
                    @forelse ($prescriptions as $prescription)
                        <div class="border border-slate-100 rounded-xl p-5 flex gap-5">
                            <img src="{{ asset('storage/' . $prescription->image_path) }}" alt="Prescription" class="w-32 h-32 object-cover rounded-lg border border-slate-200">

                            <div class="flex-1">
                                <p class="text-slate-800"><strong>Customer:</strong> {{ $prescription->user->name ?? 'N/A' }}</p>
                                <p class="text-sm text-slate-500">Uploaded {{ $prescription->created_at->format('d M Y, h:i A') }}</p>
                                <p class="mt-1">
                                    <span class="px-2 py-1 text-xs rounded-full
                                        @if($prescription->status === 'pending') bg-amber-100 text-amber-800
                                        @elseif($prescription->status === 'approved') bg-teal-100 text-teal-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst($prescription->status) }}
                                    </span>
                                </p>

                                @if ($prescription->status === 'pending')
                                    <div class="mt-3 flex gap-2">
                                        <form action="{{ route('admin.prescriptions.update-status', $prescription) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">Approve</button>
                                        </form>
                                        <form action="{{ route('admin.prescriptions.update-status', $prescription) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-sm font-medium px-4 py-2 rounded-lg transition" onclick="return confirm('Reject this prescription? Linked pending order will be cancelled.');">Reject</button>
                                        </form>
                                    </div>
                                @else
                                    <p class="mt-2 text-sm text-slate-500">{{ $prescription->admin_notes ?? 'No notes.' }}</p>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-slate-500 py-6">No prescriptions found.</p>
                    @endforelse
                </div>

                <div class="mt-4">{{ $prescriptions->links() }}</div>

            </div>
        </div>
    </div>
</x-app-layout>