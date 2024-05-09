<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\Jugador;
use App\Models\Equipo;

class JugadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jugadores = Jugador::withTrashed()->get();
        return view('jugador.index')->with('jugadores', $jugadores);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $equipos = Equipo::all();
        return view('jugador.create')->with('equipos', $equipos);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_equipo' => 'required|integer',
            'numero' => 'required|integer|min:1',
            'posicion' => 'required|string|max:15',
            'nacionalidad' => 'required|string|max:15',
            'nombre' => 'required|string|max:30',
            'apellido' => 'required|string|max:30',
        ]);
    
        $jugador = new Jugador();
    
        $jugador->equipo_id = $validatedData['id_equipo'];
        $jugador->numero = $validatedData['numero'];
        $jugador->posicion = $validatedData['posicion'];
        $jugador->nacionalidad = $validatedData['nacionalidad'];
        $jugador->nombre = $validatedData['nombre'];
        $jugador->apellido = $validatedData['apellido'];
        $jugador->foto = '';

        $jugador->save();    

        return redirect('/jugadores');
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
        $jugador = Jugador::find($id);
        $equipos = Equipo::all();
        return view('jugador.edit')->with([
            'jugador' => $jugador,
            'equipos' => $equipos,
        ]);      
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'id_equipo' => 'required|integer',
            'numero' => 'required|integer|min:1',
            'posicion' => 'required|string|max:15',
            'nacionalidad' => 'required|string|max:15',
            'nombre' => 'required|string|max:30',
            'apellido' => 'required|string|max:30',
        ]);
    
        $jugador = Jugador::find($id);
    
        $jugador->equipo_id = $validatedData['id_equipo'];
        $jugador->numero = $validatedData['numero'];
        $jugador->posicion = $validatedData['posicion'];
        $jugador->nacionalidad = $validatedData['nacionalidad'];
        $jugador->nombre = $validatedData['nombre'];
        $jugador->apellido = $validatedData['apellido'];

        $jugador->save();    

        return redirect('/jugadores');     
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jugador = Jugador::find($id);
        $jugador->delete();
        return redirect('/jugadores');
    }

    public function restore(string $id)
    {
        $jugador = Jugador::withTrashed()->findOrFail($id);
        $jugador->restore();

        return redirect('/jugadores');
    }
}
