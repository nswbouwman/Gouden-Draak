<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/kassa', function () {
    return view('/cashdesk/index');
})->middleware(['auth'])->name('kassa-index');

Route::get('/kassa/menu', function () {
    return view('/cashdesk/menu');
})->middleware(['auth'])->name('kassa-menu');

Route::get('/legacy', function () {
    return view('legacy.index.html');
});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
