<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DishType;
use Illuminate\Http\Request;

class AdminDishTypeController extends Controller
{
    public function index()
    {
        $categories = DishType::orderBy('name')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:dish_types,name',
        ]);

        DishType::create(['name' => $request->name]);

        return redirect()->route('admin.categories.index')->with('success', 'Categorie toegevoegd.');
    }

    public function edit(DishType $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, DishType $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:dish_types,name,' . $category->id,
        ]);

        $category->update(['name' => $request->name]);

        return redirect()->route('admin.categories.index')->with('success', 'Categorie bijgewerkt.');
    }

    public function destroy(DishType $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Categorie verwijderd.');
    }
}
