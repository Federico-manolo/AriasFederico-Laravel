@extends('layouts.plantillabase');

@section('css')
    <link rel="stylesheet" href="{{ Vite::asset("resources/css/crud.css") }}">
@endsection

@section('contenido')
    <div class="title-container">
        <h1 class="title">Jugadores de {{$nombreEquipo}}</h1>
    </div>

    <table id="jugadoresEnEquipo" class="table table-dark  table-hover mt-4">
        <thead>
            <tr>
                <th scope="col">ID</th>  
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Nacionalidad</th>
                <th scope="col">Número Camiseta</th>
                <th scope="col">ID del Equipo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jugadores as $jugador)
                <tr>
                    <td>{{$jugador ->id}}</td>
                    <td>{{$jugador ->nombre}}</td>
                    <td>{{$jugador ->apellido}}</td>
                    <td>{{$jugador ->nacionalidad}}</td>
                    <td>{{$jugador ->numero}}</td>
                    <td>{{$jugador ->equipo ->id}}</td>
                </tr>
            @endforeach                   
        </tbody>        
    </table>

@section('js')
<script>
    const tabla = '#jugadoresEnEquipo';
</script>
<script src="{{ Vite::asset('resources/js/crud.js') }}"></script>
@endsection

<a href="/equipos" class="btn btn-primary">Volver</a> 

@endsection
