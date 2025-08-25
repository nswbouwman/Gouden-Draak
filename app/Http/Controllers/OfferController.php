<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index()
    {
        $offers = MenuItem::where('is_offer', true)->get();
        return view('offers', compact('offers'));
    }
}
