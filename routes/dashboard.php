<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\Auth\LoginController;
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\Dashboard\QuoteController;
use App\Http\Controllers\Dashboard\ProfileController;
use Illuminate\Support\Facades\Route;

/* Public Routes Dashboard - Auth */

Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('login.post');

/* Protected Routes - Dashboard */
Route::middleware(['auth'])->prefix('admin')->name('dashboard.')->group(function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('home');

    // Contacts Routes
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

    // Quotes Routes
    Route::get('/quotes', [QuoteController::class, 'index'])->name('quotes.index');
    Route::get('/quotes/{quote}', [QuoteController::class, 'show'])->name('quotes.show');
    Route::delete('/quotes/{quote}', [QuoteController::class, 'destroy'])->name('quotes.destroy');

    // Profile Routes
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

/* Logout Route - Must be outside prefix to work correctly */
Route::middleware(['auth'])->post('/admin/logout', [LoginController::class, 'logout'])->name('dashboard.logout');
