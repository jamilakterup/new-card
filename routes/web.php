<?php

use App\Http\Controllers\CardController;
// use App\Http\Controllers\DesignController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\IdCard\IdCardModule;

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


// Route::get('/design', function () {
//     return view('userTemplate.pages.design');
// })->middleware(['auth', 'verified'])->name('design');

// admin dashboard
Route::get('/dashboard', function () {
    return view('adminTemplate.pages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// card crud ================
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('dashboard/card', CardController::class);
});

// design route ================
Route::middleware(['auth', 'verified'])->group(function () {
    // Route::resource('design', DesignController::class);
    Route::get('/design', IdCardModule::class);
});
