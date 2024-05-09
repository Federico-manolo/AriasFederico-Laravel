<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JugadorController;
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
    if (Auth::check()) {
        return redirect('/dashboard');
    } else {
        return redirect('/login');
    }
});

Route::middleware(['auth'])->group(function () {
    Route::resource('cartas','App\Http\Controllers\CartaController');
    Route::resource('jugadores','App\Http\Controllers\JugadorController');
    Route::resource('usuarios','App\Http\Controllers\UsuarioController');


    Route::resource('equipos','App\Http\Controllers\EquipoController');
    Route::resource('pedidos','App\Http\Controllers\PedidoController');
    Route::resource('equipos/{id}/{nombre}/jugador','App\Http\Controllers\JugadorEnEquipoController');
    Route::resource('pedidos/{id}/carta','App\Http\Controllers\CartasDePedidoController');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::put('equipos/restore/{id}', 'App\Http\Controllers\EquipoController@restore');
    Route::put('jugadores/restore/{id}', 'App\Http\Controllers\JugadorController@restore');
    Route::put('cartas/restore/{id}', 'App\Http\Controllers\CartaController@restore');
    Route::put('pedidos/restore/{id}', 'App\Http\Controllers\PedidoController@restore');
    Route::put('usuarios/restore/{id}', 'App\Http\Controllers\UsuarioController@restore');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

require __DIR__.'/auth.php';
