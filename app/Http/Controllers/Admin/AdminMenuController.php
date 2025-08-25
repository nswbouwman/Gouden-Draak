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
        $dishTypes = DishType::with(['menuItems' => function ($query) {
            $query->orderBy('menu_number')->orderBy('menu_suffix');
        }])->get();
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
            'no_numbering' => 'boolean',
            'is_offer' => 'boolean',
            'offer_price' => 'nullable|numeric|min:0',
        ]);

        $menuNumber = null;
        $menuSuffix = null;

        // If no numbering is requested, leave both null
        if (!$request->no_numbering) {
            if ($request->base_menu_number) {
                // Creating a variant of existing item
                $lastVariant = MenuItem::where('dish_type_id', $request->dish_type_id)
                    ->where('menu_number', $request->base_menu_number)
                    ->orderBy('menu_suffix', 'desc')
                    ->first();

                $menuNumber = $request->base_menu_number;
                
                if ($lastVariant && $lastVariant->menu_suffix) {
                    // Increment existing suffix (a->b, b->c, etc.)
                    $menuSuffix = chr(ord($lastVariant->menu_suffix) + 1);
                } else {
                    // First variant gets 'a'
                    $menuSuffix = 'a';
                }
            } else {
                // Creating a new item with new number
                $lastItem = MenuItem::where('dish_type_id', $request->dish_type_id)
                    ->whereNotNull('menu_number')
                    ->orderBy('menu_number', 'desc')
                    ->first();

                $menuNumber = $lastItem ? $lastItem->menu_number + 1 : 1;
                $menuSuffix = null;
            }
        }

        MenuItem::create([
            'dish_type_id' => $request->dish_type_id,
            'menu_number' => $menuNumber,
            'menu_suffix' => $menuSuffix,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'is_offer' => $request->boolean('is_offer'),
            'offer_price' => $request->offer_price,
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

        $menu->update([
            'dish_type_id' => $request->dish_type_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'is_offer' => $request->boolean('is_offer'),
            'offer_price' => $request->offer_price,
        ]);

        return redirect()->route('admin.menu.index')->with('success', 'Gerecht bijgewerkt.');
    }

    public function destroy(MenuItem $menu)
    {
        $menu->delete();
        return redirect()->route('admin.menu.index')->with('success', 'Gerecht verwijderd.');
    }
}