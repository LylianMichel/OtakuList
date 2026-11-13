<?php

use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OeuvreController;
use Illuminate\Support\Facades\Route;

// Pages statiques : le contenu variable est rendu par les vues Blade.
Route::get('/', [CatalogueController::class, 'index'])->name('home');
Route::view('/a-propos', 'pages.about')->name('about');
Route::view('/contact', 'pages.contact')->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/oeuvres', [OeuvreController::class, 'index'])
    ->name('oeuvres.index');
