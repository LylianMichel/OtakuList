<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\OeuvreController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');
Route::view('/a-propos', 'pages.about')->name('about');
Route::view('/contact', 'pages.contact')->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::view('/mon-compte/mot-de-passe', 'auth.update-password')
    ->middleware('auth')->name('password.edit');

Route::middleware('auth')->group(function (): void {
    Route::get('/profil', [ProfilController::class, 'show'])->name('profil.show');
    Route::get('/profil/edit', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');
});

Route::get('/oeuvres', [OeuvreController::class, 'index'])->name('oeuvres.index');
