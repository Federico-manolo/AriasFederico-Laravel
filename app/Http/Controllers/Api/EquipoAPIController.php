<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equipo;
use App\Models\Jugador;
use OpenApi\Annotations as OA;


class EquipoAPIController extends Controller
{
    /**
     * @OA\Get(
     *     path="/rest/equipos",
     *     tags={"Equipos"},
     *     summary="Obtiene todos los equipos",
     *     @OA\Response(
     *         response="200",
     *         description="Lista de todos los equipos"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="No se encontraron equipos"
     *     )
     * )
     */
    public function getEquipos(){
        $equipos = Equipo::all();
        return response()->json($equipos);
    }
    /**
    * @OA\Get(
    *     path="/rest/equipoID/{id}",
    *     tags={"Equipos"},
    *     summary="Obtiene un equipo por ID",
    *     @OA\Parameter(
    *         name="id",
    *         description="ID del equipo",
    *         required=true,
    *         in="path",
    *         @OA\Schema(
    *             type="integer"
    *         )
    *     ),
    *     @OA\Response(
    *         response="200",
    *         description="Equipo encontrado"
    *     ),
    *     @OA\Response(
    *         response="404",
    *         description="Equipo no encontrado"
    *     )
    * )
    */
    public function getEquipoByID(string $id){
        $equipo = Equipo::find($id);  
        return response()->json($equipo); 
    }
    /**
     * @OA\Get(
     *     path="/rest/equipoJugador/{id}",
     *     tags={"Equipos"},
     *     summary="Obtiene el equipo de un jugador",
     *     @OA\Parameter(
     *         name="id_jugador",
     *         in="path",
     *         description="ID del jugador",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Equipo del jugador"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="No se encontró el jugador o no tiene equipo asignado"
     *     )
     * )
     */
    public function getEquipoByJugador($id_jugador){
        $jugador = Jugador::find($id_jugador);
        $equipo = $jugador->equipo;
        return response()->json($equipo);
    }
     
}
