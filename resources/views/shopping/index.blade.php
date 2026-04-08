@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-4">
    <h1 class="text-2xl font-semibold mb-4">Shopping List</h1>

    <form action="/shopping-items" method="POST" class="mb-6 flex gap-2">
        @csrf
        <input type="text" name="name" placeholder="Item name" required class="flex-1 border rounded px-3 py-2" />
        <input type="number" name="quantity" min="1" value="1" class="w-24 border rounded px-3 py-2" />
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Add</button>
    </form>

    <ul class="space-y-3">
        @forelse($items as $item)
            <li class="flex items-center justify-between p-3 border rounded">
                <div class="flex items-center gap-3">
                    <form action="/shopping-items/{{ $item->id }}/toggle" method="POST">
                        @csrf
                        <button type="submit" class="p-1 rounded border hover:bg-gray-100">
                            @if($item->completed)
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414L8.414 15 5 11.586a1 1 0 011.414-1.414L8.414 12.172l6.879-6.879a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path d="M10 18a8 8 0 100-16 8 8 0 000 16z"/></svg>
                            @endif
                        </button>
                    </form>

                    <div>
                        <div class="text-sm font-medium {{ $item->completed ? 'line-through opacity-50' : '' }}">{{ $item->name }}</div>
                        <div class="text-xs text-gray-500">Quantity: {{ $item->quantity }} @if($item->notes) &middot; {{ $item->notes }} @endif</div>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <form action="/shopping-items/{{ $item->id }}" method="POST" onsubmit="return confirm('Delete this item?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-sm text-red-600 hover:underline">Delete</button>
                    </form>
                </div>
            </li>
        @empty
            <li class="text-gray-500">No items yet.</li>
        @endforelse
    </ul>
</div>
@endsection
