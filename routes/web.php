<?php
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\EnappsysController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/detailedpage', [EnappsysController::class, 'getEnappsysData'])->name('detailedpage');
Route::get('/errorpage', function () {
    return view('errorpage');
})->name('errorpage');
Route::resource('recipes', RecipeController::class);
