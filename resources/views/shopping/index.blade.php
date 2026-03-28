@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="max-w-4xl mx-auto">
        <header class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Shopping List</h1>
            <p class="text-sm text-gray-600">Add items you need to buy and remove them when done.</p>
        </header>

        @livewire('shopping-list')
    </div>
</div>
@endsection
