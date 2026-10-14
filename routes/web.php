<?php

use App\Http\Controllers\CatalogueController;
use Illuminate\Support\Facades\Route;

// Pages statiques : le contenu variable est rendu par les vues Blade.
Route::get('/', [CatalogueController::class, 'index'])->name('home');
Route::view('/a-propos', 'pages.about')->name('about');
Route::view('/contact', 'pages.contact')->name('contact');
