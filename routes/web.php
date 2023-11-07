<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ParqueController;
use App\Http\Controllers\BrinquedoController;
use App\Http\Controllers\VendaController;

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

Route::resource('/parque', ParqueController::class);
Route::resource('/brinquedo', BrinquedoController::class);
Route::resource('/venda', VendaController::class);

// Home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
