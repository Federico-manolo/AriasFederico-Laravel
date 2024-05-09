<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equipo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipos = Equipo::withTrashed()->get();
        return view('equipo.index')->with('equipos', $equipos);
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
        $equipo = Equipo::find($id);
        return view('equipo.edit')->with('equipo',$equipo);  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:60',
            'ciudad' => 'required|string|max:60',
        ]);
        if($validatedData){
            $equipo = Equipo::find($id);

            $equipo->nombre = $validatedData['nombre'];
            $equipo->ciudad = $validatedData['ciudad'];

            if ($request->hasFile('imagenUrl')) {
                $image = $request->file('imagenUrl');
                $uploadedFile = $image->storeOnCloudinary('equipos');
                $equipo->logo = $uploadedFile->getSecurePath();
            }
            $equipo->save();    
        
        }    
        return redirect('/equipos')->with('success', 'Equipo creado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $equipo = Equipo::find($id);
        $equipo->delete();
        return redirect('/equipos');
    }
    
    public function restore(string $id)
    {
        echo "Hols";
        $equipo = Equipo::withTrashed()->findOrFail($id);
        echo $equipo;
        $equipo->restore();

        return redirect('/equipos');
    }
}