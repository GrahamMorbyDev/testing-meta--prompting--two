<div>
    {{-- Livewire Shopping List --}}

    @if(isset($items) && $items->count())
        <ul class="space-y-2">
            @foreach($items as $item)
                <li class="flex items-center justify-between p-3 rounded-md hover:bg-gray-50">
                    <div class="flex items-center space-x-3">
                        <button
                            type="button"
                            wire:click="toggleCompleted({{ $item->id }})"
                            wire:loading.attr="disabled"
                            wire:target="toggleCompleted({{ $item->id }})"
                            class="flex items-center justify-center w-8 h-8 rounded-full border transition-colors focus:outline-none"
                            :class="{ 'bg-green-500 border-green-500 text-white': {{ $item->completed ? 'true' : 'false' }}, 'bg-white border-gray-200': {{ $item->completed ? 'false' : 'true' }} }"
                        >
                            @if($item->completed)
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z" clip-rule="evenodd" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300" viewBox="0 0 20 20" fill="none" stroke="currentColor" aria-hidden="true">
                                    <circle cx="10" cy="10" r="3.5" stroke-width="2" />
                                </svg>
                            @endif
                        </button>

                        <div class="min-w-0">
                            <div class="flex items-baseline space-x-2">
                                <p class="truncate text-sm font-medium {{ $item->completed ? 'line-through text-gray-400' : 'text-gray-900' }}">
                                    {{ $item->name }}
                                </p>
                                @if(!empty($item->quantity))
                                    <span class="text-xs text-gray-500">&middot; {{ $item->quantity }}</span>
                                @endif
                            </div>

                            @if(!empty($item->notes))
                                <p class="mt-1 text-xs text-gray-500 {{ $item->completed ? 'line-through text-gray-300' : '' }}">{{ $item->notes }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center space-x-3">
                        {{-- optional: timestamp or meta --}}
                        @if(isset($item->completed_at) && $item->completed)
                            <span class="text-xs text-green-600">Purchased</span>
                        @endif

                        <button
                            type="button"
                            wire:click="deleteItem({{ $item->id }})"
                            class="text-xs text-red-500 hover:underline"
                            wire:loading.attr="disabled"
                        >
                            Remove
                        </button>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <div class="text-center py-12 text-gray-500">
            <p class="text-sm">No items yet. Add something to your shopping list.</p>
        </div>
    @endif
</div>
