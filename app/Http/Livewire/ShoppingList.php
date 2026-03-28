<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ShoppingItem;
use Illuminate\Support\Facades\Auth;

class ShoppingList extends Component
{
    public $name = '';
    public $quantity = 1;
    public $notes = '';
    public $items = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'quantity' => 'required|integer|min:1',
        'notes' => 'nullable|string|max:1000',
    ];

    protected $listeners = ['deleteItem'];

    public function mount()
    {
        $this->loadItems();
    }

    public function loadItems()
    {
        // If ShoppingItem has a user association, filter by current user if authenticated
        if (Auth::check()) {
            $this->items = ShoppingItem::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        } else {
            $this->items = ShoppingItem::orderBy('created_at', 'desc')->get();
        }
    }

    public function addItem()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'quantity' => $this->quantity,
            'notes' => $this->notes,
        ];

        if (Auth::check()) {
            $data['user_id'] = Auth::id();
        }

        ShoppingItem::create($data);

        $this->resetInputFields();
        $this->loadItems();

        $this->dispatchBrowserEvent('shopping-item-added');
    }

    public function deleteItem($id)
    {
        $item = ShoppingItem::find($id);

        if (! $item) {
            return;
        }

        // If item belongs to a user, ensure current user owns it (if applicable)
        if (Auth::check() && isset($item->user_id) && $item->user_id !== Auth::id()) {
            return; // silent fail for unauthorized delete
        }

        $item->delete();

        $this->loadItems();
    }

    protected function resetInputFields()
    {
        $this->name = '';
        $this->quantity = 1;
        $this->notes = '';
    }

    public function render()
    {
        return view('livewire.shopping-list');
    }
}
