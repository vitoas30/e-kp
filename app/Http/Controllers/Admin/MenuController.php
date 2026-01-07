<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('admin.menu.index', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $menu = new Menu();
        $menu->name = $request->name;
        $menu->description = $request->description;
        $menu->save();

        return redirect()->route('admin.menu.index')->with('success', 'Menu created successfully.');
    }
    
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $menu = Menu::findOrFail($id);
        $menu->name = $request->name;
        $menu->description = $request->description;
        $menu->save();

        return redirect()->route('admin.menu.index')->with('success', 'Menu updated successfully.');
    }

    public function destroy(string $id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();
        return redirect()->route('admin.menu.index')->with('success', 'Menu deleted successfully');
    }
}
