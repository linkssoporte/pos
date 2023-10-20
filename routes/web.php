<?php

use App\Http\Livewire\Tester;
use App\Http\Livewire\Products;
use App\Http\Livewire\Suppliers;
use App\Http\Livewire\Categories;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('categories', Categories::class)->name('categories');
Route::get('suppliers', Suppliers::class)->name('suppliers');
Route::get('products', Products::class)->name('products');
Route::get('data/categories', [DataController::class, 'getCategories'])->name('data.categories');


Route::get('tester', Tester::class)->name('tester');

require __DIR__.'/auth.php';