@extends('layouts.plantillabase');
@section('css')
    <link rel="stylesheet" href={{ Vite::asset('resources/css/crud.css') }}  >
@endsection
@section('contenido')

<div class="title-container">
    <h1 class="title">Usuarios registrados:</h1>
</div>
<table id="usuarios" class="table table-dark table-hover mt-4">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>E-Mail</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($usuarios as $usuario)
        <tr @if($usuario->deleted_at) class="borrado" @endif>
            <td>{{$usuario->id}}</td>
            <td>{{$usuario->name}}</td>
            <td>{{$usuario->email}}</td>
            <td>
            @if($usuario->deleted_at)
                    <form action="/usuarios/restore/{{$usuario->id}}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success">Restaurar</button>
                    </form>
                @else
                    <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST">
                        <a href="/usuarios/{{$usuario->id}}/edit" class="btn btn-info">Editar</a>
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
    const tabla = '#usuarios';
</script>
<script src="{{ Vite::asset('resources/js/crud.js') }}"></script>
@endsection
@endsection