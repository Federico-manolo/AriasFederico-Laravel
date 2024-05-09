@extends('layouts.plantillabase');

@section('contenido')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Crear Jugador</h1>
        </div>
        <div class="card-body">
            <form action="/jugadores" method="POST" class="form">
                @csrf
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" name="apellido" id="apellido" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="nacionalidad">Nacionalidad</label>
                    <input type="text" name="nacionalidad" id="nacionalidad" class="form-control">
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
                        <option >PG</option>
                        <option >SG</option>
                        <option >SF</option>
                        <option >PF</option>
                        <option >C</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="numero">Numero</label>
                    <input type="number" name="numero" id="numero" class="form-control" >
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
                <button type="submit" class="btn btn-primary">Crear</button>
            </form>
        </div>
    </div>
</div>
@endsection