<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use App\Http\Controllers\AlumniController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('alumni')
    ->name('alumni.')
    ->group(function () {
        Route::get('/form', [AlumniController::class, 'create'])->name('create');
        Route::post('/form', [AlumniController::class, 'store'])->name('store');
    });

require __DIR__.'/settings.php';
