<?php

namespace App\Http\Controllers\Admin;

use App\Enums\MethodEnums;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\PositionCategory;
use App\Models\SubMenu;
use Illuminate\Http\Request;

class SubMenuController extends Controller
{
    public function index()
    {
        $submenus = SubMenu::all();
        $menus = Menu::all();
        $positions = PositionCategory::all();
        $methods = MethodEnums::cases();
        return view('admin.sub-menu.index', compact('submenus', 'menus', 'positions', 'methods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        if(is_array($request->position)) {
            foreach($request->position as $position) {
                $submenu = new SubMenu();
                $submenu->menu_id = $request->menu;
                $submenu->position_id = $position;
                $submenu->name = $request->name;
                $submenu->description = $request->description;
                $submenu->save();
            }
        }

        return redirect()->route('admin.sub-menu.index')->with('success', 'Sub Menu created successfully.');
    }
    
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $menu = SubMenu::findOrFail($id);
        $menu->menu_id = $request->menu;
        $menu->position_id = $request->position;
        $menu->name = $request->name;
        $menu->description = $request->description;
        $menu->save();

        return redirect()->route('admin.sub-menu.index')->with('success', 'Sub Menu updated successfully.');
    }

    public function destroy(string $id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();
        return redirect()->route('admin.sub-menu.index')->with('success', 'Menu deleted successfully');
    }
}
