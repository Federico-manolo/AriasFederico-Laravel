<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CartaAPIController; 
use App\Http\Controllers\Api\EquipoAPIController; 
use App\Http\Controllers\Api\UsuarioAPIController; 
use App\Http\Controllers\Api\JugadorAPIController; 
use App\Http\Controllers\Api\PedidoAPIController; 
use App\Http\Controllers\Api\MercadoPagoAPIController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register',[UsuarioAPIController::class, 'register']);
Route::post('login',[UsuarioAPIController::class, 'login']);

Route::group(['middleware' => ["auth:sanctum"]], function(){
    //rutas 
    Route::get('pedidosUsuario', [UsuarioAPIController::class,'pedidosUsuario']);
    Route::post('logout', [UsuarioAPIController::class,'logout']);  
    Route::post('/process-payment',[MercadoPagoAPIController::class, 'processPayment']);
    Route::post('/cargarPedido', [PedidoAPIController::class, 'guardarPedido']);
    Route::post('/montoTotal', [PedidoAPIController::class, 'montoTotal']);
});

Route::get('/cartaPorJugador/{nombre_jugador}/{apellido_jugador}', [CartaAPIController::class, 'getCartaByJugadorByName']);
Route::get('/cartas', [CartaAPIController::class, 'getCartas']);
Route::get('/cartaConJugador', [CartaAPIController::class, 'getCartaConJugadorConEquipo']);
Route::get('/cartaPorId/{id}', [CartaAPIController::class, 'getCartaByID']);
Route::get('/cartasPorEquipoPorID/{id_equipo}', [CartaAPIController::class, 'getCartasByEquipoByID']);
Route::get('/cartasPorEquipoPorNombre/{nombre_equipo}', [CartaAPIController::class, 'getCartasByEquipoByNameConJugadores']);
Route::get('/cartasPorCategoria/{categoria}', [CartaAPIController::class, 'getCartaConJYEPorCategoria']);

Route::get('/equipos', [EquipoAPIController::class, 'getEquipos']);
Route::get('/equipoJugador/{id}', [EquipoAPIController::class, 'getEquipoByJugador']);
Route::get('/equipoID/{id}', [EquipoAPIController::class, 'getEquipoByID']);

Route::get('/miUsuario/{id}', [UsuarioAPIController::class, 'getUsuario']);
Route::post('/miUsuario/nuevaContraseña/{id}', [UsuarioAPIController::class, 'updatePassword']);

Route::get('/jugadores', [JugadorAPIController::class, 'getJugadores']);
Route::get('/jugador/{nombre}/{apellido}', [JugadorAPIController::class, 'getJugadorByName']);
Route::get('/jugadorPorID/{id}', [JugadorAPIController::class, 'getJugadorByID']);
Route::get('/jugadoresConEquipos', [JugadorAPIController::class, 'getJugadoresConEquipos']);


