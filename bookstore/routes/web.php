<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\InvoiceController;

Route::get('/', function () {
    return redirect()->route('books.index');
});

Route::get('/books', [BookController::class, 'index'])->name('books.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::resource('books', BookController::class)->except(['index', 'show']);


    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{book}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');


    Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
    Route::get('/invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');

    Route::get('/topup', [ProfileController::class, 'showTopUpForm'])->name('topup.form');
    Route::post('/topup', [ProfileController::class, 'processTopUp'])->name('topup.process');
});

Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

require __DIR__.'/auth.php';
