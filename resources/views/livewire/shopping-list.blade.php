<div class="space-y-3">
    @if(isset($items) && count($items))
        @foreach($items as $item)
            <div class="flex items-center justify-between p-3 border rounded">
                <div class="flex items-center gap-3">
                    <form action="/shopping-items/{{ $item->id }}/toggle" method="POST">
                        @csrf
                        <button type="submit" class="p-1 rounded">
                            @if($item->completed)
                                <span class="text-green-600">✓</span>
                            @else
                                <span class="text-gray-400">○</span>
                            @endif
                        </button>
                    </form>

                    <div class="{{ $item->completed ? 'line-through opacity-50' : '' }}">
                        <div class="font-medium">{{ $item->name }}</div>
                        <div class="text-xs text-gray-500">Qty: {{ $item->quantity }}</div>
                    </div>
                </div>

                <div>
                    <form action="/shopping-items/{{ $item->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    @else
        <div class="text-gray-500">No shopping items.</div>
    @endif
</div>
