<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carta;
use App\Models\Equipo;
use App\Models\Jugador;
use OpenApi\Annotations as OA;


class CartaAPIController extends Controller
{
    /**
     * @OA\Get(
     *     path="/rest/cartas",
     *     tags={"Cartas"},
     *     summary="Obtiene todas las cartas",
     *     @OA\Response(
     *         response="200",
     *         description="Lista de todas las cartas"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="No se encontraron cartas"
     *     )
     * )
     */
    public function getCartas() {
        $cartas = Carta::all();
        return response()->json($cartas);
    }
    /**
     * @OA\Get(
     *     path="/rest/cartaPorId/{id}",
     *     tags={"Cartas"},
     *     summary="Obtiene una carta por ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la carta a obtener",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Carta encontrada"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="No se encontró la carta"
     *     )
     * )
     */
    public function getCartaByID(string $id){
        $carta = Carta::find($id);  
        return response()->json($carta);  
    }
    /**
     * @OA\Get(
     *     path="/rest/cartasPorEquipoPorID/{id_equipo}",
     *     tags={"Cartas"},
     *     summary="Obtiene las cartas asociadas a un equipo por ID",
     *     @OA\Parameter(
     *         name="id_equipo",
     *         in="path",
     *         required=true,
     *         description="ID del equipo para obtener las cartas",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Lista de las cartas asociadas al equipo"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="No se encontraron cartas asociadas al equipo"
     *     )
     * )
     */
    public function getCartasByEquipoByID(string $id_equipo){
        $jugadores = Equipo::findOrFail($id_equipo)->jugadoresAsociados;
        $cartas = Carta::whereIn('jugador_id', $jugadores->pluck('id'))->get();
        return response()->json($cartas);
        
    }
    /**
     * @OA\Get(
     *     path="/rest/cartaPorEquipoPorNombre/{nombre_equipo}",
     *     tags={"Cartas"},
     *     summary="Obtiene las cartas asociadas a un equipo por nombre",
     *     @OA\Parameter(
     *         name="nombre_equipo",
     *         in="path",
     *         required=true,
     *         description="Nombre del equipo para obtener las cartas",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Lista de las cartas asociadas al equipo"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="No se encontraron cartas asociadas al equipo"
     *     )
     * )
     */
    public function getCartasByEquipoByNameConJugadores(string $nombre_equipo){
        $equipo = Equipo::where('nombre', $nombre_equipo)->first();

        if (!$equipo) {
            return response()->json(['error' => 'Equipo no encontrado'], 404);
        }

        $jugadores = $equipo->jugadoresAsociados;
        $cartas = Carta::whereIn('jugador_id', $jugadores->pluck('id'))->get();

        $response = $cartas->map(function ($carta) {
            return [
                'id' => $carta->id,
                'descripcion' => $carta->descripcion,
                'costo' => $carta->costo,
                'estadistica' => $carta->estadistica,
                'categoria' => $carta->categoria,
                'jugador' => [
                    'id' => $carta->jugador->id,
                    'nombre' => $carta->jugador->nombre,
                    'apellido' => $carta->jugador->apellido,
                    'nacionalidad' => $carta->jugador->nacionalidad,
                    'Nro_Camiseta' => $carta->jugador->numero,
                    'posicion' => $carta->jugador->posicion,
                    'foto' => $carta->jugador->foto,
                    'equipo' => [
                        'id' => $carta->jugador->equipo->id,
                        'ciudad' => $carta->jugador->equipo->ciudad,
                        'nombre' => $carta->jugador->equipo->nombre,
                        'logo' => $carta->jugador->equipo->logo,
                    ],
                ],
            ];
        });

        return response()->json($response);
    }

    /**
     * @OA\Get(
     *     path="/rest/cartaPorJugador/{nombre_jugador}/{apellido_jugador}",
     *     tags={"Cartas"},
     *     summary="Obtiene la carta asociada a un jugador por nombre y apellido",
     *     @OA\Parameter(
     *         name="nombre_jugador",
     *         in="path",
     *         required=true,
     *         description="Nombre del jugador para obtener su carta",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="apellido_jugador",
     *         in="path",
     *         required=true,
     *         description="Apellido del jugador para obtener su carta",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="La carta asociada al jugador"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="No se encontró la carta asociada al jugador"
     *     )
     * )
     */
    public function getCartaByJugadorByName(string $nombre_jugador, string $apellido_jugador){
        $id_jugador = Jugador::where([
            ['nombre', '=', $nombre_jugador],
            ['apellido', '=', $apellido_jugador],
        ])->first()->id;
        $carta = Carta::where('jugador_id', $id_jugador)->get();
        return response()->json($carta);
    }
    /**
     * @OA\Get(
     *     path="/rest/cartaConJugador",
     *     tags={"Cartas"},
     *     summary="Obtiene todas las cartas con la información del jugador asociado",
     *     @OA\Response(
     *         response="200",
     *         description="Lista de todas las cartas con información del jugador asociado",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(
     *                     property="id",
     *                     type="integer",
     *                     description="ID de la carta"
     *                 ),
     *                 @OA\Property(
     *                     property="descripcion",
     *                     type="string",
     *                     description="Descripción de la carta"
     *                 ),
     *                 @OA\Property(
     *                     property="costo",
     *                     type="integer",
     *                     description="Costo de la carta"
     *                 ),
     *                 @OA\Property(
     *                     property="estadistica",
     *                     type="string",
     *                     description="Estadística asociada a la carta"
     *                 ),
     *                 @OA\Property(
     *                     property="categoria",
     *                     type="string",
     *                     description="Categoría de la carta"
     *                 ),
     *                 @OA\Property(
     *                     property="jugador",
     *                     type="object",
     *                     description="Información del jugador asociado a la carta",
     *                     @OA\Property(
     *                         property="id",
     *                         type="integer",
     *                         description="ID del jugador"
     *                     ),
     *                     @OA\Property(
     *                         property="nombre",
     *                         type="string",
     *                         description="Nombre del jugador"
     *                     ),
     *                     @OA\Property(
     *                         property="apellido",
     *                         type="string",
     *                         description="Apellido del jugador"
     *                     ),
     *                     @OA\Property(
     *                         property="nacionalidad",
     *                         type="string",
     *                         description="Nacionalidad del jugador"
     *                     ),
     *                     @OA\Property(
     *                         property="Nro_Camiseta",
     *                         type="integer",
     *                         description="Número de camiseta del jugador"
     *                     ),
     *                     @OA\Property(
     *                         property="posicion",
     *                         type="string",
     *                         description="Posición del jugador"
     *                     ),
     *                     @OA\Property(
     *                         property="foto",
     *                         type="string",
     *                         description="URL de la foto del jugador"
     *                     ),
     *                     @OA\Property(
     *                         property="ID_equipo",
     *                         type="integer",
     *                         description="ID del equipo al que pertenece el jugador"
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */

    public function getCartaConJugadorConEquipo() {
        $cartas = Carta::with('jugador', 'jugador.equipo')->get();
        $cartasConJugador = $cartas->map(function ($carta) {
            return [
                'id' => $carta->id,
                'descripcion' => $carta->descripcion,
                'costo' => $carta->costo,
                'estadistica' => $carta->estadistica,
                'categoria' => $carta->categoria,
                'jugador' => [
                    'id' => $carta->jugador->id,
                    'nombre' => $carta->jugador->nombre,
                    'apellido' => $carta->jugador->apellido,
                    'nacionalidad' => $carta->jugador->nacionalidad,
                    'Nro_Camiseta' => $carta->jugador->numero,
                    'posicion' => $carta->jugador->posicion,
                    'foto' => $carta->jugador->foto,
                    'equipo' => [
                        'id' => $carta->jugador->equipo->id,
                        'ciudad' => $carta->jugador->equipo->ciudad,
                        'nombre' => $carta->jugador->equipo->nombre,
                        'logo' => $carta->jugador->equipo->logo,
                    ],
                ],
            ];
        });
        return response()->json($cartasConJugador);
    }
    
    public function getCartaConJYEPorCategoria(string $categoria, Request $request) {
        $pagina = $request->query('página', 1); // Obtener el número de página de la consulta o usar el valor predeterminado 1
        $tamañoPagina = $request->query('tamaño_página', 3); // Obtener el tamaño de página de la consulta o usar el valor predeterminado 10
        
        $cartas = Carta::with('jugador', 'jugador.equipo')
                        ->where('categoria', $categoria)
                        ->skip(($pagina - 1) * $tamañoPagina) // Calcular el número de registros para omitir en la consulta
                        ->take($tamañoPagina) // Especificar el tamaño de página para la consulta
                        ->get();
    
        $totalElementos = Carta::where('categoria', $categoria)->count(); // Obtener el número total de elementos sin paginación
    
        $cartasConJugador = $cartas->map(function ($carta) {
            return [
                'id' => $carta->id,
                'descripcion' => $carta->descripcion,
                'costo' => $carta->costo,
                'estadistica' => $carta->estadistica,
                'categoria' => $carta->categoria,
                'jugador' => [
                    'id' => $carta->jugador->id,
                    'nombre' => $carta->jugador->nombre,
                    'apellido' => $carta->jugador->apellido,
                    'nacionalidad' => $carta->jugador->nacionalidad,
                    'Nro_Camiseta' => $carta->jugador->numero,
                    'posicion' => $carta->jugador->posicion,
                    'foto' => $carta->jugador->foto,
                    'equipo' => [
                        'id' => $carta->jugador->equipo->id,
                        'ciudad' => $carta->jugador->equipo->ciudad,
                        'nombre' => $carta->jugador->equipo->nombre,
                        'logo' => $carta->jugador->equipo->logo,
                    ],
                ],
            ];
        });
        
        return response()->json($cartasConJugador);
    }
    
}
