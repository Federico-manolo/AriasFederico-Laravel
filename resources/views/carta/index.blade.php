@extends('layouts.plantillabase')

@section('css')
    <link rel="stylesheet" href={{ Vite::asset("resources/css/crud.css") }}  >
@endsection
@section('contenido')

<div class="title-container">
    <h1 class="title">Cartas:</h1>
    <a href="cartas/create" class="btn btn-info btn-create">
        <i class="fas fa-plus"></i> Crear Carta
    </a>
</div>
<table id="cartas" class="table table-dark table-hover mt-4">
    <thead>
        <tr>
            <th>ID</th>
            <th>Descripción</th>
            <th>Costo</th>
            <th>Estadística</th>
            <th>Categoría</th>
            <th>Jugador</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cartas as $carta)
        <tr @if($carta->deleted_at) class="borrado" @endif>
            <td>{{$carta->id}}</td>
            <td>{{$carta->descripcion}}</td>
            <td>{{$carta->costo}}</td>
            <td>{{$carta->estadistica}}</td>
            <td>{{$carta->categoria}}</td>
            <td>{{$carta->jugador->apellido}}, {{$carta->jugador->nombre}}</td>
            <td>
                @if($carta->deleted_at)
                    <form action="/cartas/restore/{{$carta->id}}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success" onclick="return confirm('¿Está seguro de que desea restaurar este registro?')">Restaurar</button>
                    </form>
                @else
                <form action="{{ route('cartas.destroy', $carta->id) }}" method="POST" id="form-delete">
                    <a href="/cartas/{{$carta->id}}/edit" class="btn btn-info">Editar</a>
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
    const tabla = '#cartas';
</script>
<script src="{{ Vite::asset('resources/js/crud.js') }}"></script>
@endsection

@endsection
