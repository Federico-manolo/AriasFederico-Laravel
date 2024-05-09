@extends('layouts.plantillabase');

@section('css')
    <link rel="stylesheet" href={{ Vite::asset("resources/css/crud.css") }}  >
@endsection

@section('contenido')
    <div class="title-container">
        <h1 class="title">Cartas del Pedido ID: {{$pedido->id}}</h1>
    </div>
    <table id="cartas_en_pedido" class="table table-dark table-striped table-hover mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Descripción</th>
                <th>Cantidad </th>
                <th>Costo</th>
                <th>Estadística</th>
                <th>Categoría</th>
                <th>Jugador</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedido->cartasEnPedido as $carta)
            <tr>
                <td>{{$carta->id}}</td>
                <td>{{$carta->descripcion}}</td>
                <td>{{$carta->pivot->cant_producto}}</td>
                <td>{{$carta->costo}}</td>
                <td>{{$carta->estadistica}}</td>
                <td>{{$carta->categoria}}</td>
                <td>{{$carta->jugador->apellido}}, {{$carta->jugador->nombre}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @section('js')
    <script>
      const tabla = '#cartas_en_pedido';
    </script>
    <script src="{{ Vite::asset('resources/js/crud.js') }}"></script>
    @endsection

    <a href="/pedidos" class="btn btn-primary">Volver</a> 
@endsection
