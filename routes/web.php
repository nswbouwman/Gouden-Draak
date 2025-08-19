<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CashDeskController;
use App\Http\Controllers\OrderController;
// TODO This controller doesn't exist v
use App\Http\Controllers\SalesOverviewController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/menukaart', [MenuController::class, 'menu'])->name('menu');

Route::post('/menu/favorite/toggle', [MenuController::class, 'toggleFavorite'])->name('menu.favorite.toggle');

Route::get('/nieuws', function () {
    return view('news');
})->name('news');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/kassa', [CashDeskController::class, 'index'])->middleware(['auth'])->name('cashdesk.index');
Route::get('/kassa/menu', [CashDeskController::class, 'menu'])->middleware(['auth'])->name('cashdesk.menu');

Route::get('/verkoopoverzicht', [CashDeskController::class, 'salesOverview'])->name('sales.index');
Route::post('/verkoopoverzicht/data', [CashDeskController::class, 'salesOverviewData'])->name('sales.data');

Route::get('/bestellingen/{table_nr}', [OrderController::class, 'index'])->name('orders.index');
Route::post('/bestellingen/{table_nr}', [OrderController::class, 'store'])->name('orders.store');

Route::post('/orders', [CashDeskController::class, 'storeOrder'])->middleware('auth');

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
