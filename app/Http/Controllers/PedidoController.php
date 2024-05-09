<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pedidos = Pedido::withTrashed()->get();
        return view('pedido.index')->with('pedidos', $pedidos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'estado' => 'required|string|max:20',
        ]);
    
        $pedido = Pedido::find($id);
        if (!$pedido) {
            throw new \Exception("El pedido con el id $id no existe");
        }

        $pedido->estado = $validatedData['estado'];
        $pedido->save();
    
        return redirect()->route('pedidos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pedido = Pedido::find($id);
        $pedido->delete();
        return redirect('/pedidos');
    }
    public function restore(string $id)
    {
        $pedido = Pedido::withTrashed()->findOrFail($id);
        $pedido->restore();

        return redirect('/pedidos');
    }
}
