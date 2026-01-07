<?php

namespace App\Http\Controllers\Admin;

use App\Enums\MethodEnums;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\PositionCategory;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        $menus = Menu::all();
        $positions = PositionCategory::all();
        $methods = MethodEnums::cases();
        return view('admin.permission.index', compact('permissions', 'menus', 'positions', 'methods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        if(is_array($request->position)) {
            foreach($request->position as $position) {
                $permission = new Permission();
                $permission->menu_id = $request->menu;
                $permission->position_id = $position;
                $permission->name = $request->name;
                $permission->description = $request->description;
                $permission->save();
            }
        }

        return redirect()->route('admin.permission.index')->with('success', 'Permission created successfully.');
    }
    
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $permission = Permission::findOrFail($id);
        $permission->menu_id = $request->menu;
        $permission->position_id = $request->position;
        $permission->name = $request->name;
        $permission->description = $request->description;
        $permission->save();

        return redirect()->route('admin.permission.index')->with('success', 'Permission updated successfully.');
    }

    public function destroy(string $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return redirect()->route('admin.permission.index')->with('success', 'Permission deleted successfully');
    }
}
