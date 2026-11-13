<?php

use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OeuvreController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');
Route::view('/a-propos', 'pages.about')->name('about');
Route::view('/contact', 'pages.contact')->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::view('/mon-compte/mot-de-passe', 'auth.update-password')
    ->middleware('auth')->name('password.edit');

Route::get('/oeuvres', [OeuvreController::class, 'index'])->name('oeuvres.index');
Route::get('/oeuvres', [OeuvreController::class, 'index'])
    ->name('oeuvres.index');
