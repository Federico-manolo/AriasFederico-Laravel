<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equipo;

class JugadorEnEquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id, string $nombre)
    {
        $equipo = Equipo::find($id);
        $jugadores = $equipo->jugadoresAsociados()->orderBy('id')->get();
        return view('jugadores_en_equipo.index')->with([
            'jugadores' => $jugadores,
            'nombreEquipo' => $equipo->nombre
        ]);; 
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
