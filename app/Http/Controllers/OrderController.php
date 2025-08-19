<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DishType;

class OrderController extends Controller
{
    public function index($table_nr)
    {
        $dishTypes = DishType::with(['menuItems' => function ($query) {
            $query->orderBy('menu_number')->orderBy('menu_suffix');
        }])->get();

        return view('orders', compact('table_nr', 'dishTypes'));
    }

    public function store(Request $request, $table_nr)
    {
        $validated = $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:menu_items,id',
            'items.*.quantity' => 'required|integer|min:1|max:20',
        ]);

        return response()->json(['success' => true]);
    }
}
