<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pedido;
use Illuminate\Validation\ValidationException;
use OpenApi\Annotations as OA;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Traits\HttpResponses;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Contracts\Auth\Authenticatable;


class UsuarioAPIController extends Controller
{
    use HttpResponses;
    /**
     * @OA\Get(
     *      path="/rest/miUsuario/{id}",
     *      summary="Obtener un usuario por ID",
     *      description="Retorna un usuario según su ID",
     *      tags={"Usuarios"},
     *      @OA\Parameter(
     *          name="id",
     *          description="ID del usuario a obtener",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="OK"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Usuario no encontrado"
     *      )
     * )
     */
    public function getUsuario($id){
        $usuario = User::find($id);
        return response()->json($usuario);
    }

    /**
     * @OA\Put(
     *      path="/rest/miUsuario/nuevaContraseña/{id}",
     *      summary="Actualizar la contraseña de un usuario por ID",
     *      description="Actualiza la contraseña de un usuario según su ID",
     *      tags={"Usuarios"},
     *      @OA\Parameter(
     *          name="id",
     *          description="ID del usuario a actualizar",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          @OA\JsonContent(
     *              required={"password"},
     *              @OA\Property(
     *                  property="password",
     *                  type="string",
     *                  example="nuevacontraseña"
     *              ),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Usuario actualizado correctamente"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Usuario no encontrado"
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Error de validación",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="El campo password es obligatorio."
     *              ),
     *              @OA\Property(
     *                  property="errors",
     *                  type="object",
     *                  example={
     *                      "password": {"El campo password es obligatorio."}
     *                  }
     *              )
     *          )
     *      )
     * )
     */

    public function updatePassword(Request $request, string $id){
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
        $validatedData = $request->validate([
            'password' => 'required|string|max:255|unique:users'
        ]);
        $user->password =  bcrypt($validatedData['password']);
        $user->save();
        return response()->json(['message' => 'Usuario actualizado correctamente'], 200);
    }

    public function register(Request $request){
        $jsResponse = null;
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ]);

        $user = new User(); 
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;

        $user-> save();

        $jsResponse = $this->success([
            'user' => $user,
            'token' => $user->createToken('API token of '. $user->email)->plainTextToken,
        ]);

        return $jsResponse;
    }
    
    public function login(Request $request){
        $jsResponse = null;
        //Acá validamos si los datos ingresados son correctos semánticamente 
        $credentials = $request->validate([
            'email' => ['required','string', 'email'],
            'password' => ['required'],
        ]); 
         
        if(Auth::attempt($credentials)) {
            $user = User::where('email', $request->email)->first(); 
                
            $jsResponse = $this->success([
                'user' => $user, 
                'token' => $user->createToken('Api token of '. $user->email)->plainTextToken      
            ]);
        }else {
            $jsResponse = $this->error('','Las credenciales son incorrectas', 401);
        }
 
       return $jsResponse;
    }
    
    public function pedidosUsuario(Request $request){
        
        $user = $request->user();
        $pedidos = Pedido::Where('user_id', $user->id)->get();

        $pedidosConCartas = $pedidos->map(function($pedido){
            $cartas = $pedido->cartasEnPedido;
            $cartas = $cartas->map(function($carta){
                return [
                    'id' => $carta->id,
                    'costo' => $carta->costo,
                    'cantidad' => $carta->pivot->cant_producto,
                    'jugador' => [
                        'id' => $carta->id,
                        'nombre' => $carta->jugador->nombre,
                        'apellido' => $carta->jugador->apellido,
                    ],
                ];
            });
            return [
                'id' => $pedido->id,
                'estado' => $pedido->estado,
                'fecha_pedido' => $pedido->fecha_pedido,
                'fecha_entrega' => $pedido->fecha_entrega,
                'monto_total' => $pedido->monto_total,
                'cartas' => $cartas,
            ];
        });

        return response()->json($pedidosConCartas);
        
    }
    
    public function logout(Request $request){
        $user = $request->user(); 

        $user->tokens()->delete();
     
        return response()->json([
            "status" => 1,
            "msg" => "Sesión cerrada",
        ]);

    }

}
