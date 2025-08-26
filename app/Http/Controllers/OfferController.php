<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class OfferController extends Controller
{
    public function index()
    {
        $locale = substr(request()->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
        if (in_array($locale, ['en', 'nl'])) {
            App::setLocale($locale);
        }

        $offers = MenuItem::where('is_offer', true)->get();
        return view('offers', compact('offers'));
    }
}
