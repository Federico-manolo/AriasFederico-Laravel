@extends('layouts.plantillabase');

@section('contenido')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Crear una Carta</h1>
        </div>
        <div class="card-body">
            <form action="/cartas" method="POST" class="form">
                @csrf
                <div class="form-group">
                    <label for="id_jugador">Jugador</label>
                    <select name="id_jugador" id="id_jugador" class="form-control">
                        @foreach ($jugadores as $jugador)
                            <option value="{{ $jugador->id }}">{{ $jugador->apellido }}, {{ $jugador->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                        <label for="categoria">Categoría</label>
                        <select name="categoria" id="categoria" class="form-control">
                            <option value="oro">Oro</option>
                            <option value="plata">Plata</option>
                            <option value="bronce">Bronce</option>
                        </select>
                    </div>
                <div class="form-group">
                    <label for="estadistica">Estadística</label>
                    <input type="number" name="estadistica" id="estadistica" class="form-control" placeholder="Ingrese la estadística3">
                </div>
                <div class="form-group">
                    <label for="precio">Costo</label>
                    <input type="number" name="precio" id="precio" value= "0" class="form-control" placeholder="Ingrese el monto correspondiente">
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea id = "descripcion" name="descripcion" class ="form-control"></textarea>
                </div>
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <a href="/cartas" class ="btn btn-primary">Cancelar</a>    
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
</div>
@endsection