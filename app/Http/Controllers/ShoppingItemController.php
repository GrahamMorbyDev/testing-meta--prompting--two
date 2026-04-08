<?php

namespace App\Http\Controllers;

use App\Models\ShoppingItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShoppingItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the shopping items for the authenticated user.
     */
    public function index(Request $request)
    {
        $items = $request->user()->shoppingItems()->latest()->get();
        return view('shopping.index', compact('items'));
    }

    /**
     * Store a newly created shopping item.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'nullable|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $data['quantity'] = $data['quantity'] ?? 1;

        $request->user()->shoppingItems()->create($data);

        return redirect()->back()->with('success', 'Item added.');
    }

    /**
     * Toggle the completed (purchased) state of the specified shopping item.
     */
    public function toggle(ShoppingItem $shoppingItem, Request $request)
    {
        if ($shoppingItem->user_id !== $request->user()->id) {
            abort(403);
        }

        $shoppingItem->toggleCompleted();

        return redirect()->back()->with('success', 'Item updated.');
    }

    /**
     * Remove the specified shopping item.
     */
    public function destroy(ShoppingItem $shoppingItem, Request $request)
    {
        if ($shoppingItem->user_id !== $request->user()->id) {
            abort(403);
        }

        $shoppingItem->delete();

        return redirect()->back()->with('success', 'Item deleted.');
    }
}
