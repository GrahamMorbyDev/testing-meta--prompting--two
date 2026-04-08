<?php echo '<?php'; ?>
@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-4">Shopping List</h1>

    {{-- Add Item Form --}}
    <div class="bg-white shadow rounded-lg p-4 mb-6">
        <form action="{{ route('shopping.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-3 items-end">
            @csrf

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input name="name" required type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="e.g. Apples">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Quantity</label>
                <input name="quantity" required type="number" min="1" value="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="md:col-span-4">
                <label class="block text-sm font-medium text-gray-700">Notes (optional)</label>
                <input name="notes" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="e.g. Granny Smith">
            </div>

            <div class="md:col-span-4">
                <button type="submit" class="mt-2 inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Add Item
                </button>
            </div>
        </form>

        @if ($errors->any())
            <div class="mt-3 text-sm text-red-600">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    {{-- Items List --}}
    <div class="bg-white shadow rounded-lg p-4">
        @if($items->count())
            <ul class="space-y-3">
                @foreach($items as $item)
                    <li class="flex items-start justify-between border p-3 rounded">
                        <div>
                            <div class="flex items-baseline space-x-3">
                                <h3 class="text-lg font-medium">{{ $item->name }}</h3>
                                <span class="text-sm text-gray-500">x {{ $item->quantity }}</span>
                            </div>

                            @if($item->notes)
                                <p class="text-sm text-gray-600 mt-1">{{ $item->notes }}</p>
                            @endif

                            <p class="text-xs text-gray-400 mt-2">Added {{ $item->created_at->diffForHumans() }}</p>
                        </div>

                        <div class="flex items-center space-x-2">
                            <form action="{{ route('shopping.destroy', $item) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-sm rounded hover:bg-red-700">Delete</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>

            <div class="mt-4 text-sm text-gray-600">
                Showing {{ $items->count() }} item(s).
            </div>
        @else
            <div class="text-gray-600">No items yet. Add some using the form above.</div>
        @endif
    </div>
</div>
@endsection
