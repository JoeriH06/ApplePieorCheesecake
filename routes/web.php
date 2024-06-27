<?php
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\EnappsysController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Authentication routes
Auth::routes();

// Routes requiring authentication
Route::middleware(['auth'])->group(function () {
    Route::get('/detailedpage', [EnappsysController::class, 'getEnappsysData'])->name('detailedpage');
    Route::get('/errorpage', function () {
        return view('errorpage');
    })->name('errorpage');
    Route::resource('recipes', RecipeController::class);
});

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
