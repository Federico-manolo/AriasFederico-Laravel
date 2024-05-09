<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\Pedido;
use App\Models\Carta;


class PedidoAPIController extends Controller
{


    public function montoTotal(Request $request) {
        $validatedData = $request->validate([
            'estado' => 'required|string|max:255',
            'fecha_pedido' => 'required|date',
            'fecha_entrega' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'cartas' => 'required|array',
            'cartas.*.id' => 'exists:carta,id',
            'cartas.*.cant_producto' => 'required|integer|min:1',
        ]);
    
        $cartas = $validatedData['cartas'];
    
        $cartaIds = collect($cartas)->pluck('id')->toArray();
        $cartasFromDb = Carta::whereIn('id', $cartaIds)->get()->keyBy('id');
    
        $total = 0;
    
        foreach ($cartas as $carta) {
            $cartaFromDb = $cartasFromDb[$carta['id']];
            $total += $cartaFromDb->costo * $carta['cant_producto'];
        }

        $response = [
            'monto_total' => $total
        ];
        
        return response()->json($response);
    }
    /**
     * @OA\Post(
     *     path="/rest/cargarPedido",
     *     tags={"Pedidos"},
     *     summary="Crea un nuevo pedido",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="estado", type="string", description="Estado del pedido"),
     *             @OA\Property(property="fecha_pedido", type="date", description="Fecha en que se realizó el pedido"),
     *             @OA\Property(property="fecha_entrega", type="date", description="Fecha de entrega del pedido"),
     *             @OA\Property(property="monto_total", type="integer", description="Monto total del pedido"),
     *             @OA\Property(property="user_id", type="integer", description="ID del usuario que realizó el pedido"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="Pedido creado correctamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Pedido creado correctamente")
     *         )
     *     ),
     *     @OA\Response(
     *         response="422",
     *         description="Error de validación",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Los datos proporcionados no son válidos"),
     *             @OA\Property(property="errors", type="object", description="Objeto con los errores de validación")
     *         )
     *     )
     * )
     */
    public function guardarPedido(Request $request) {
        $validatedData = $request->validate([
            'estado' => 'required|string|max:255',
            'fecha_pedido' => 'required|date',
            'fecha_entrega' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'cartas' => 'required|array',
            'cartas.*.id' => 'exists:carta,id',
            'cartas.*.cant_producto' => 'required|integer|min:1',
        ]);
    
        $cartas = $validatedData['cartas'];
    
        $cartaIds = collect($cartas)->pluck('id')->toArray();
        $cartasFromDb = Carta::whereIn('id', $cartaIds)->get()->keyBy('id');
    
        $cartasWithCantidades = [];
        $total = 0;
    
        foreach ($cartas as $carta) {
            $cartaFromDb = $cartasFromDb[$carta['id']];
            $cartasWithCantidades[$carta['id']] = ['cant_producto' => $carta['cant_producto']];
            $total += $cartaFromDb->costo * $carta['cant_producto'];
        }
    
        $pedido = new Pedido();
        $pedido->estado = $validatedData['estado'];
        $pedido->fecha_pedido = $validatedData['fecha_pedido'];
        $pedido->fecha_entrega = $validatedData['fecha_entrega'];
        $pedido->user_id = $validatedData['user_id'];
        $pedido->monto_total = $total; // Set the calculated total
        $pedido->save();
    
        $pedido->cartasEnPedido()->attach($cartasWithCantidades);
    
        return response()->json(['message' => 'Pedido creado correctamente'], 201);
    }
}
