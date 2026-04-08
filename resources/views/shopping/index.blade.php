@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8 px-4">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">Shopping List</h1>
        <p class="text-sm text-gray-500">Mark items purchased to keep track of what you've bought.</p>
    </div>

    <div class="bg-white shadow-sm rounded-lg p-4">
        @livewire('shopping-list')
    </div>
</div>
@endsection
