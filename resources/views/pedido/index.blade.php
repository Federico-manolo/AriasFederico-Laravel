@extends('layouts.plantillabase');

@section('css')
    <link rel="stylesheet" href={{ Vite::asset('resources/css/crud.css'); }}  >
@endsection
@section('contenido');

<div class="title-container">
    <h1 class="title">Pedidos:</h1>
</div>
<table id="pedidos" class = "table table-dark  table-hover mt-4">
    <thead>
        <tr>
          <th scope = "col">ID</th>  
          <th scope = "col">Fecha Creación del Pedido</th>
          <th scope = "col">Fecha de Entrega</th>
          <th scope = "col">ID Usuario</th>
          <th scope = "col">Monto Total</th>
          <th scope = "col">Estado del Pedido</th>      
          <th scope = "col"></th>          
        </tr>
    </thead>
    <tbody>
        @foreach ($pedidos as $pedido)
        <tr @if($pedido->deleted_at) class="borrado" @endif>
            <td>{{$pedido ->id}}</td>
            <td>{{$pedido ->fecha_pedido}}</td>
            <td>{{$pedido ->fecha_entrega}}</td>
            <td>{{$pedido ->user_id}}</td>
            <td>{{$pedido ->monto_total}}</td>
            <td>
                <div>{{$pedido->estado}}</div>
                @if(!$pedido->deleted_at)
                    <form action="{{ route('pedidos.update', $pedido->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="btn-group">
                        @if ($pedido->estado == 'Pendiente')
                            <button type="submit" class="btn btn-primary" name="estado" value="Procesando">Procesando</button>
                        @endif
                        @if ($pedido->estado == 'Procesando')
                            <button type="submit" class="btn btn-primary" name="estado" value="Enviado">Enviado</button>
                        @endif
                        @if ($pedido->estado == 'Enviado')
                            <button type="submit" class="btn btn-primary" name="estado" value="Entregado">Entregado</button>
                        @endif
                        @if ($pedido->estado == 'Entregado')
                            <button type="submit" class="btn btn-primary" name="estado" value="Pendiente">Pendiente</button>
                        @endif
                        </div>
                    </form>
                @endif
            </td>
            <td>
                @if($pedido->deleted_at)
                    <form action="/pedidos/restore/{{$pedido->id}}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success" onclick="return confirm('¿Está seguro de que desea restaurar este registro?')">Restaurar</button>
                    </form>
                @else
                    <form action="{{route ('pedidos.destroy', $pedido->id)}}" method="POST">
                        <a href="/pedidos/{{$pedido->id}}/carta" class = "btn btn-info ">Cartas del Pedido</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class = "btn btn-danger" onclick="return confirm('¿Está seguro de que desea eliminar este registro?')">Borrar</button>
                    </form>
                @endif
            </td>
        </tr>
        @endforeach                   
    </tbody>        
</table>   
@section('js')
<script>
    const tabla = '#pedidos';
</script>
<script src="{{ Vite::asset('resources/js/crud.js') }}"></script>
@endsection

@endsection