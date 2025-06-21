<?php

namespace App\Http\Controllers;

use App\Models\DishType;

class CashDeskController extends Controller
{
    public function index()
    {
        $dishTypes = DishType::with(['menuItems' => function ($query) {
            $query->orderBy('menu_number')->orderBy('menu_suffix');
        }])->get();

        return view('cashdesk.index', compact('dishTypes'));
    }
}
