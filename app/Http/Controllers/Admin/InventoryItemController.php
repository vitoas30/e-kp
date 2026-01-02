<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InventoryItem;
use App\Models\CategoryItem;
use App\Models\User;
use Illuminate\Http\Request;

class InventoryItemController extends Controller
{
    public function index()
    {
        $items = InventoryItem::with(['category', 'user'])->get();
        $categories = CategoryItem::all();
        $users = User::all();
        return view('admin.inventory.items.index', compact('items', 'categories', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:inventory_items',
            'category_item_id' => 'nullable|exists:category_items,id',
            'description' => 'nullable|string',
            'purchase_date' => 'nullable|date',
        ]);

        InventoryItem::create($request->all());

        return redirect()->route('admin.inventory.items.index')->with('success', 'Item created successfully.');
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:inventory_items,code,' . $id,
            'category_item_id' => 'nullable|exists:category_items,id',
            'description' => 'nullable|string',
            'user_id' => 'nullable|exists:users,id',
            'condition' => 'required|string',
            'purchase_date' => 'nullable|date',
        ]);

        $item = InventoryItem::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('admin.inventory.items.index')->with('success', 'Item updated successfully.');
    }

    public function destroy(string $id)
    {
        $item = InventoryItem::findOrFail($id);
        $item->delete();
        return redirect()->route('admin.inventory.items.index')->with('success', 'Item deleted successfully.');
    }
}
