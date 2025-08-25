<?php

namespace App\Http\Controllers\Admin;

use App\Models\MenuItem;
use App\Models\DishType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminMenuController extends Controller
{
    public function index()
    {
        $dishTypes = DishType::with('menuItems')->get();
        return view('admin.menu.index', compact('dishTypes'));
    }

    public function create()
    {
        $dishTypes = DishType::all();
        return view('admin.menu.create', compact('dishTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dish_type_id' => 'required|exists:dish_types,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'base_menu_number' => 'nullable|integer',
        ]);

        if ($request->base_menu_number) {
            $lastVariant = MenuItem::where('dish_type_id', $request->dish_type_id)
                ->where('menu_number', $request->base_menu_number)
                ->orderBy('menu_suffix', 'desc')
                ->first();

            $newSuffix = $lastVariant && $lastVariant->menu_suffix
                ? chr(ord($lastVariant->menu_suffix) + 1)
                : 'a';

            $menuNumber = $request->base_menu_number;
            $menuSuffix = $newSuffix;
        } else {
            $lastItem = MenuItem::where('dish_type_id', $request->dish_type_id)
                ->orderBy('menu_number', 'desc')
                ->first();

            $menuNumber = $lastItem ? $lastItem->menu_number + 1 : 1;
            $menuSuffix = null;
        }

        MenuItem::create([
            'dish_type_id' => $request->dish_type_id,
            'menu_number' => $menuNumber,
            'menu_suffix' => $menuSuffix,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.menu.index')->with('success', 'Gerecht toegevoegd.');
    }

    public function edit(MenuItem $menu)
    {
        $dishTypes = DishType::all();
        return view('admin.menu.edit', compact('menu', 'dishTypes'));
    }

    public function update(Request $request, MenuItem $menu)
    {
        $request->validate([
            'dish_type_id' => 'required|exists:dish_types,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'is_offer' => 'boolean',
            'offer_price' => 'nullable|numeric|min:0',
        ]);

        $menu->update($request->only(
            'dish_type_id','name','description','price','is_offer','offer_price'
        ));

        return redirect()->route('admin.menu.index')->with('success', 'Gerecht bijgewerkt.');
    }

    public function destroy(MenuItem $menu)
    {
        $menu->delete();
        return redirect()->route('admin.menu.index')->with('success', 'Gerecht verwijderd.');
    }
}
