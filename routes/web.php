<?php

use App\Http\Controllers\Auth\Request;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BrinquedoController;
use App\Http\Controllers\VendaController;



Auth::routes();

Route::resource('/brinquedo', BrinquedoController::class);
Route::resource('/venda', VendaController::class);

// Home
Route::redirect('/', '/home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

