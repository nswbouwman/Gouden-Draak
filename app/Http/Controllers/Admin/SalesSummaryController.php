<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SalesSummaryController extends Controller
{
    public function index()
    {
        $files = Storage::files('sales');

        return view('admin.sales.index', compact('files'));
    }

    public function download($file)
    {
        return Storage::download("sales/{$file}");
    }
}
