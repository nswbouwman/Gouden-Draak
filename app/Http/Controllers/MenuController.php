<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\DishType;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function menu()
    {
        $menuItems = MenuItem::with('dishType')
            ->get()
            ->sortBy(function ($item) {
                return $item->dishType->name . '-' . str_pad($item->menu_number ?? 0, 3, '0', STR_PAD_LEFT);
            })
            ->groupBy(function ($item) {
                return $item->dishType->name;
            });

        return view('menu', compact('menuItems'));
    }
}
