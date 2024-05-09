@extends('layouts.plantillabase')

@section('contenido')

<h2> Editar Registro</h2>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Editemos la carta {{$carta->id}}</h1>
        </div>
        <div class="card-body">
            <form action="/cartas/{{$carta->id}}" method="POST" class="form">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="id_jugador">Jugador</label>
                    <select name="id_jugador" id="id_jugador" class="form-control">
                        @foreach ($jugadores as $jugador)
                            <option value="{{ $jugador->id }}" {{ $carta->jugador_id == $jugador->id ? 'selected' : '' }}>{{ $jugador->apellido }}, {{ $jugador->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="categoria">Categoría</label>
                    <select name="categoria" id="categoria" class="form-control">
                        <option {{ $carta->categoria == 'Oro' ? 'selected' : '' }}>Oro</option>
                        <option {{ $carta->categoria == 'Plata' ? 'selected' : '' }}>Plata</option>
                        <option {{ $carta->categoria == 'Bronce' ? 'selected' : '' }}>Bronce</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="estadistica">Estadística</label>
                    <input type="number" name="estadistica" id="estadistica" class="form-control" value="{{$carta->estadistica}}">
                </div>
                <div class="form-group">
                    <label for="precio">Costo</label>
                    <input type="number" name="precio" id="precio" class="form-control" value="{{$carta->costo}}">
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea id = "descripcion" name="descripcion" class ="form-control" >{{$carta->descripcion}}</textarea>
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

@endsection('contenido')