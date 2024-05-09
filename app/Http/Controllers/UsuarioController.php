<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $usuarios = User::withTrashed()->get();
    return view('usuario.index')->with('usuarios', $usuarios);
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
        $usuario = User::find($id);
        return view('usuario.edit')->with('usuario',$usuario);   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,'.$id,
            ]);
    
            $usuario = User::find($id);
            if (!$usuario) {
                throw new \Exception("El usuario con el id $id no existe");
            }
    
            $usuario->name = $validatedData['name'];
            $usuario->email = $validatedData['email'];
            $usuario->save();
    
            return redirect('/usuarios');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/usuarios');
    }
    public function restore(string $id)
    {
        $usuario = User::withTrashed()->findOrFail($id);
        $usuario->restore();

        return redirect('/usuarios');
    }
}

