<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CashDeskController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SalesOverviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/menukaart', function () {
    return view('menu');
})->name('menu');

Route::get('/nieuws', function () {
    return view('news');
})->name('news');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/kassa', [CashDeskController::class, 'index'])->middleware(['auth'])->name('cashdesk.index');

Route::get('/kassa/menu', function () {
    return view('/cashdesk/menu');
})->middleware(['auth'])->name('cashdesk.menu');

Route::get('/sales', [SalesOverviewController::class, 'index'])->name('sales.index');
Route::post('/sales/data', [SalesOverviewController::class, 'data'])->name('sales.data');

Route::post('/orders', [OrderController::class, 'store'])->middleware('auth');

Route::get('/legacy', function () {
    return view('legacy.index.html');
});

Route::get('/logout', function () {
    session()->flush();
    return redirect('/');
})->name('logout');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
