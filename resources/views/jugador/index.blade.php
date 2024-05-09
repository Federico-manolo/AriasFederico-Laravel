@extends('layouts.plantillabase')

@section('css')
    <link rel="stylesheet" href={{ Vite::asset("resources/css/crud.css") }}  >
@endsection
@section('contenido')
<div class="title-container">
    <h1 class="title">Jugadores:</h1>
    <a href="jugadores/create" class="btn btn-info btn-create">
        <i class="fas fa-plus"></i> Crear Jugador
    </a>


</div>
<table id="jugadores" class="table table-dark table-hover mt-4">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Equipo</th>
            <th>Nacionalidad</th>
            <th>Numero</th>
            <th>Posicion</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($jugadores as $jugador)
        <tr @if($jugador->deleted_at) class="borrado" @endif>
            <td>{{$jugador->id}}</td>
            <td>{{$jugador->nombre}}</td>
            <td>{{$jugador->apellido}}</td>
            <td>{{$jugador->equipo->ciudad}} {{$jugador->equipo->nombre}}</td>
            <td>{{$jugador->nacionalidad}}</td>
            <td>{{$jugador->numero}}</td>
            <td>{{$jugador->posicion}}</td>
            <td>
                @if($jugador->deleted_at)
                    <form action="/jugadores/restore/{{$jugador->id}}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success" onclick="return confirm('¿Está seguro de que desea restaurar este registro?')">Restaurar</button>
                    </form>
                @else
                    <form action="{{ route('jugadores.destroy', $jugador->id) }}" method="POST">
                        <a href="/jugadores/{{$jugador->id}}/edit" class="btn btn-info">Editar</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de que desea eliminar este registro?')">Borrar</button>
                    </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@section('js')
<script>
    const tabla = '#jugadores';
</script>
<script src={{ Vite::asset('resources/js/crud.js') }}></script>
@endsection

@endsection
