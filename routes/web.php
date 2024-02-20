<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProfileController;
use App\Livewire\IdCard\CardMapping;
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
    return 'ddas';
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


// card crud ================
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('dashboard', CardController::class);
});

// design route ================
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/card/mapping', CardMapping::class);
    Route::get('design/pdf/{id}', function ($card_id) {
        return view('userTemplate.pages.pdfPage', compact('card_id'));
    })->name('design/pdf');
});

Route::post('/pdf', [PdfController::class, 'generatePdf'])->name('/pdf');
