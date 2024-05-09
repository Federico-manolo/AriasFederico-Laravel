<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\Carta;
use App\Models\Jugador;

class CartaController extends Controller
{
    public function index()
    {
        $cartas = Carta::withTrashed()->get();
        return view('carta.index')->with('cartas', $cartas);
    }

    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jugadores = Jugador::all();
        return view('carta.create')->with('jugadores', $jugadores);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_jugador' => 'required|integer',
            'descripcion' => 'required|string|max:255',
            'categoria' => 'required|string|max:15',
            'precio' => 'required|numeric|max:1000000',
            'estadistica' => 'required|string|max:3',
        ]);
    
        $carta = new Carta();
    
        $carta->jugador_id = $validatedData['id_jugador'];
        $carta->descripcion = $validatedData['descripcion'];
        $carta->categoria = $validatedData['categoria'];
        $carta->costo = $validatedData['precio'];
        $carta->estadistica = $validatedData['estadistica'];
    
        $carta->save();
    
        return redirect('/cartas');
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
        $carta = Carta::find($id);
        $jugadores = Jugador::all();
        return view('carta.edit')->with([
            'carta' => $carta,
            'jugadores' => $jugadores,
        ]);      
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'id_jugador' => 'required|integer',
            'descripcion' => 'required|string|max:255',
            'categoria' => 'required|string|max:15',
            'precio' => 'required|numeric|max:1000000',
            'estadistica' => 'required|string|max:3',
        ]);
        
        $carta = Carta::find($id);

        $carta->jugador_id = $validatedData['id_jugador'];
        $carta->descripcion = $validatedData['descripcion'];
        $carta->categoria = $validatedData['categoria'];
        $carta->costo = $validatedData['precio'];
        $carta->estadistica = $validatedData['estadistica'];
    
        $carta->save();   

        return redirect('/cartas');        
    }

    /*
      Remove the specified resource from storage.
    */
    public function destroy(string $id)
    {
        $carta = Carta::find($id);
        $carta->delete();
        return redirect('/cartas');
    } 
    public function restore(string $id)
    {
        $carta = Carta::withTrashed()->findOrFail($id);
        $carta->restore();

        return redirect('/cartas');
    }
}
