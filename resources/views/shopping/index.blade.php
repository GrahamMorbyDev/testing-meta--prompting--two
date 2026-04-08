<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shopping List</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">
    @extends('layouts.app')

    @section('content')
    <div class="max-w-3xl mx-auto py-12 px-4">
        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-2xl font-semibold mb-4">Shopping List</h1>

            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="mb-4 p-3 bg-red-50 text-red-800 rounded">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('shopping.store') }}" method="POST" class="mb-6 space-y-4">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input id="name" name="name" type="text" required value="{{ old('name') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                </div>

                <div>
                    <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                    <input id="quantity" name="quantity" type="number" min="1" value="{{ old('quantity', 1) }}"
                           class="mt-1 block w-32 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                </div>

                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700">Notes (optional)</label>
                    <textarea id="notes" name="notes" rows="3"
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('notes') }}</textarea>
                </div>

                <div>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700">Add Item</button>
                </div>
            </form>

            <hr class="my-4" />

            <h2 class="text-lg font-medium mb-3">Items</h2>

            @if($items->isEmpty())
                <p class="text-sm text-gray-500">No items yet.</p>
            @else
                <ul class="space-y-3">
                    @foreach($items as $item)
                        <li class="flex items-start justify-between bg-gray-50 p-3 rounded">
                            <div>
                                <div class="font-semibold text-gray-800">{{ $item->name }} <span class="text-sm text-gray-600">&times; {{ $item->quantity }}</span></div>
                                @if($item->notes)
                                    <div class="text-sm text-gray-600 mt-1">{{ $item->notes }}</div>
                                @endif
                                <div class="text-xs text-gray-400 mt-1">Added {{ $item->created_at->diffForHumans() }}</div>
                            </div>

                            <div class="flex-shrink-0 ml-4">
                                <form action="{{ route('shopping.destroy', $item) }}" method="POST" onsubmit="return confirm('Delete this item?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-sm rounded hover:bg-red-700">Delete</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
    @endsection
</body>
</html>
