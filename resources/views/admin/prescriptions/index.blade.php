<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Prescriptions
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="GET" class="mb-4 flex gap-2">
                    <select name="status" onchange="this.form.submit()" class="border rounded px-3 py-2">
                        <option value="pending" {{ request('status', 'pending') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </form>

                <div class="space-y-4">
                    @forelse ($prescriptions as $prescription)
                        <div class="border rounded p-4 flex gap-4">
                            <img src="{{ asset('storage/' . $prescription->image_path) }}" alt="Prescription" class="w-32 h-32 object-cover border rounded">

                            <div class="flex-1">
                                <p><strong>Customer:</strong> {{ $prescription->user->name ?? 'N/A' }}</p>
                                <p><strong>Uploaded:</strong> {{ $prescription->created_at->format('d M Y, h:i A') }}</p>
                                <p><strong>Status:</strong>
                                    <span class="px-2 py-1 text-xs rounded
                                        @if($prescription->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($prescription->status === 'approved') bg-green-100 text-green-800
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
                                            <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded text-sm">Approve</button>
                                        </form>
                                        <form action="{{ route('admin.prescriptions.update-status', $prescription) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded text-sm" onclick="return confirm('Reject this prescription? Linked pending order will be cancelled.');">Reject</button>
                                        </form>
                                    </div>
                                @else
                                    <p class="mt-2 text-sm text-gray-500">{{ $prescription->admin_notes ?? 'No notes.' }}</p>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500">No prescriptions found.</p>
                    @endforelse
                </div>

                <div class="mt-4">
                    {{ $prescriptions->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>