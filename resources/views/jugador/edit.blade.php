@extends('layouts.plantillabase')

@section('contenido')

<h2> Editar Registro</h2>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Editemos al jugador {{$jugador->nombre}} {{$jugador->apellido}} ({{$jugador->id}})</h1>
        </div>
        <div class="card-body">
            <form action="/jugadores/{{$jugador->id}}" method="POST" class="form">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{$jugador->nombre}}">
                </div>
                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" name="apellido" id="apellido" class="form-control" value="{{$jugador->apellido}}">
                </div>
                <div class="form-group">
                    <label for="nacionalidad">Nacionalidad</label>
                    <input type="text" name="nacionalidad" id="nacionalidad" class="form-control" value="{{$jugador->nacionalidad}}">
                </div>
                <div class="form-group">
                    <label for="id_equipo">Equipo</label>
                    <select name="id_equipo" id="id_equipo" class="form-control">
                        @foreach ($equipos as $equipo)
                            <option value="{{ $equipo->id }}" {{ $equipo->equipo_id == $equipo->id ? 'selected' : '' }}>{{ $equipo->ciudad }} {{ $equipo->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="posicion">Posicion</label>
                    <select name="posicion" id="posicion" class="form-control">
                        <option {{ $jugador->posicion == 'PG' ? 'selected' : '' }}>PG</option>
                        <option {{ $jugador->posicion == 'SG' ? 'selected' : '' }}>SG</option>
                        <option {{ $jugador->posicion == 'SF' ? 'selected' : '' }}>SF</option>
                        <option {{ $jugador->posicion == 'PF' ? 'selected' : '' }}>PF</option>
                        <option {{ $jugador->posicion == 'C' ? 'selected' : '' }}>C</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="numero">Numero</label>
                    <input type="number" name="numero" id="numero" class="form-control" value="{{$jugador->numero}}">
                </div>
                <div class="form-group">
                    <label for="foto">Imagen</label>
                    <img src="{{$equipo->foto}}" alt="Imagen" class="img-thumbnail">
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
                <a href="/jugadores" class ="btn btn-primary">Cancelar</a>    
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
</div>

@endsection('contenido')