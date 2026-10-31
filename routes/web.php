<?php

use App\Http\Controllers\OeuvreController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');
Route::view('/a-propos', 'pages.about')->name('about');
Route::view('/contact', 'pages.contact')->name('contact');

Route::get('/oeuvres', [OeuvreController::class, 'index'])->name('oeuvres.index');
