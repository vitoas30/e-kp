<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PositionCategory;
use Illuminate\Http\Request;

class PositionCategoryController extends Controller
{
    public function index()
    {
        $categories = PositionCategory::withCount('positions')->get();
        return view('admin.position-categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);

        PositionCategory::create($request->only('name', 'description'));

        return redirect()->route('admin.position.category.index')
                         ->with('success', 'Kategori jabatan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:500',
        ]);

        $positionCategory = PositionCategory::findOrFail($id);

        $positionCategory->name = $request->name;
        $positionCategory->description = $request->description;
        $positionCategory->save();

        return redirect()->route('admin.position.category.index')
            ->with('success', 'Kategori jabatan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $positionCategory = PositionCategory::findOrFail($id);
        if($positionCategory != null) {
            $positionCategory->delete();
            
            return redirect()->route('admin.position.category.index')
            ->with('success', 'Kategori jabatan berhasil dihapus.');
        }
        return redirect()->route('admin.position.category.index')
                         ->with('message', 'Kategori jabatan gagal dihapus.');
    }

}
