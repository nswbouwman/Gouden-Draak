<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CashDeskController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminMenuController;
use App\Http\Controllers\Admin\AdminDishTypeController;
use App\Http\Controllers\Admin\SalesSummaryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $locale = substr(request()->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
    if (in_array($locale, ['en', 'nl'])) {
        App::setLocale($locale);
    }
    return view('index');
})->name('index');

Route::get('/menukaart', [MenuController::class, 'menu'])->name('menu');

Route::get('/aanbiedingen', [OfferController::class, 'index'])->name('offers');

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

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('menu', AdminMenuController::class);
    Route::resource('categories', AdminDishTypeController::class);
    Route::get('/sales', [SalesSummaryController::class, 'index'])->name('sales.index');
    Route::get('/sales/{file}', [SalesSummaryController::class, 'download'])->name('sales.download');
});

Route::get('/formulier', [FormController::class, 'index'])->name('form.index');
Route::post('/formulier', [FormController::class, 'submit'])->name('form.submit');

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
