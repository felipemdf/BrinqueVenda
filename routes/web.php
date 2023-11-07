<?php

use Illuminate\Support\Facades\Route;

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
    return redirect('/home');
});

Auth::routes();

// Home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Parque
Route::get('/parque', [App\Http\Controllers\ParqueController::class, 'index'])->name('parque');

// Brinquedo
Route::get('/brinquedo', [App\Http\Controllers\BrinquedoController::class, 'index'])->name('brinquedo');

// Venda
Route::get('/venda', [App\Http\Controllers\VendaController::class, 'index'])->name('venda');
