@extends('layouts.plantillabase');

@section('css')
    <link rel="stylesheet" href={{ Vite::asset("resources/css/crud.css") }}  >
@endsection
@section('contenido');

<div class="title-container">
    <h1 class="title">Equipos:</h1>
</div>

<table id="equipos" class = "table table-dark table-hover mt-4">
    <thead>
        <tr>
          <th scope = "col">ID</th>  
          <th scope = "col">Nombre</th>
          <th scope = "col">Ciudad</th>
          <th scope = "col">Logo</th>
          <th scope = "col">Jugadores</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($equipos as $equipo)
        <tr @if($equipo->deleted_at) class="borrado" @endif>
            <td>{{$equipo ->id}}</td>
            <td>{{$equipo ->nombre}}</td>
            <td>{{$equipo ->ciudad}}</td>
            <td><img src={{  $equipo ->logo }} alt="Logo" width="100" height="100"></td>

            <td>
                @if($equipo->deleted_at)
                    <form action="/equipos/restore/{{$equipo->id}}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success" onclick="return confirm('¿Está seguro de que desea restaurar este registro?')">Restaurar</button>
                    </form>
                @else
                    <form action="{{ route('equipos.destroy', $equipo->id) }}" method="POST">
                        <a href="/equipos/{{$equipo->id}}/edit" class="btn btn-info">Editar</a>
                        <a href="/equipos/{{$equipo->id}}/{{$equipo->nombre}}/jugador" class="btn btn-info">Jugadores del Equipo</a>
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
    const tabla = '#equipos';
</script>
<script src="{{ Vite::asset('resources/js/crud.js') }}"></script>
@endsection

@endsection