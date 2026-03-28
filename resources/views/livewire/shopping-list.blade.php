<div class="max-w-3xl mx-auto p-4">
    <div class="bg-white shadow rounded-lg p-4">
        <h2 class="text-lg font-semibold mb-3">Add Item</h2>

        <form wire:submit.prevent="addItem" class="space-y-3">
            <div>
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" wire:model.defer="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="e.g. Apples">
                @error('name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Quantity</label>
                <input type="number" min="1" wire:model.defer="quantity" class="mt-1 block w-32 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('quantity') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Notes (optional)</label>
                <textarea wire:model.defer="notes" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Optional notes..."></textarea>
                @error('notes') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center space-x-2">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Add</button>
                <button type="button" wire:click="resetInputFields" class="inline-flex items-center px-3 py-2 bg-gray-100 border border-gray-300 rounded-md text-sm hover:bg-gray-200">Reset</button>
            </div>
        </form>
    </div>

    <div class="mt-6 bg-white shadow rounded-lg p-4">
        <h3 class="text-md font-semibold mb-3">Shopping Items</h3>

        @if($items->isEmpty())
            <p class="text-sm text-gray-500">No items yet. Add something to your list.</p>
        @else
            <ul class="space-y-3">
                @foreach($items as $item)
                    <li class="flex justify-between items-start p-3 bg-gray-50 rounded-md border border-gray-100">
                        <div>
                            <div class="font-medium text-gray-900">{{ $item->name }} <span class="text-sm text-gray-500">× {{ $item->quantity }}</span></div>
                            @if(!empty($item->notes))
                                <div class="text-sm text-gray-600 mt-1">{{ $item->notes }}</div>
                            @endif
                        </div>

                        <div class="ml-4 flex-shrink-0 flex items-center space-x-2">
                            <button type="button" onclick="if(confirm('Delete this item?')) Livewire.emit('deleteItem', {{ $item->id }})" class="inline-flex items-center px-2 py-1 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-red-700 bg-red-100 hover:bg-red-200">Delete</button>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
