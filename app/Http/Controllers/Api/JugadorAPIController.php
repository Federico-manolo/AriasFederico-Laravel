<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jugador;
use OpenApi\Annotations as OA;


class JugadorAPIController extends Controller
{
    /**
     * @OA\Get(
     *     path="/rest/jugadores",
     *     tags={"Jugadores"},
     *     summary="Obtiene todos los jugadores",
     *     @OA\Response(
     *         response="200",
     *         description="Lista de todos los jugadores"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="No se encontraron jugadores"
     *     )
     * )
     */
    public function getJugadores(){
        $jugadores = Jugador::all();
        return response()->json($jugadores);
    }
    /**
     * @OA\Get(
     *     path="/rest/jugador/{nombre}/{apellido}",
     *     tags={"Jugadores"},
     *     summary="Obtiene un jugador por su nombre y apellido",
     *     @OA\Parameter(
     *         name="name",
     *         in="path",
     *         description="Nombre del jugador",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="surname",
     *         in="path",
     *         description="Apellido del jugador",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Información del jugador"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="No se encontró el jugador"
     *     )
     * )
     */

    public function getJugadorByName(string $name, string $surname){
        $jugador = Jugador::where([
            ['nombre', '=', $name],
            ['apellido', '=', $surname],
        ])->first();
        return response()->json($jugador);
    }
    /**
     * @OA\Get(
     *     path="/rest/jugadorPorID/{id}",
     *     tags={"Jugadores"},
     *     summary="Obtiene un jugador por ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del jugador",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Jugador encontrado"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Jugador no encontrado"
     *     )
     * )
     */
    public function getJugadorByID(string $id){
        $jugador = Jugador::find($id);
        return response()->json($jugador);
    }
    /**
    * @OA\Get(
    *   path="/rest/jugadoresConEquipos",
    *   tags={"Jugadores"},
    *   summary="Obtiene todos los jugadores con información de sus respectivos equipos",
    *       @OA\Response(
    *           response="200",
    *           description="Lista de todos los jugadores con información de sus respectivos equipos"
    *               ),
    *          @OA\Response(
    *               response="404",
    *               description="No se encontraron jugadores con información de sus respectivos equipos"
    *           )
    *   )
    */
    public function getJugadoresConEquipos() {
        $jugadores = Jugador::with('equipo')->get();
        $jugadoresConEquipos = $jugadores->map(function ($jugador) {
            return [
                'id' => $jugador->id,
                'nombre' => $jugador->nombre,
                'apellido'=>$jugador->apellido,
                'nacionalidad'=>$jugador->nacionalidad,
                'Nro_camiseta'=>$jugador->numero,
                'posicion'=>$jugador->posicion,
                'foto'=>$jugador->foto,
                'ID_equipo'=>$jugador->equipo_id,
                'equipo' => [
                    'id' => $jugador->equipo->id,
                    'nombre' => $jugador->equipo->nombre,
                    'ciudad' => $jugador->equipo->ciudad,
                    'logo'=> $jugador->equipo->logo,
                ],
            ];
        });
        return response()->json($jugadoresConEquipos);
    }


}
