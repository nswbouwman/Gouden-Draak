<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index()
    {
        $locale = substr(request()->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
        if (in_array($locale, ['en', 'nl'])) {
            App::setLocale($locale);
        }

        return view('form');
    }

    public function submit(Request $request)
    {
        // Validate the form data
        $request->validate([
            'experience' => 'required|string',
            'atmosphere' => 'required',
            'food' => 'required',
            'service' => 'required',
        ]);

        return redirect()->route('index');
    }
}
