@extends('layouts.plantillabase')

@section('contenido')

<h2> Editar Registro</h2>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Editemos al equipo {{$equipo->nombre}}</h1>
        </div>
        <div class="card-body">
            <form action="/equipos/{{$equipo->id}}" method="POST" enctype="multipart/form-data" class="form">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{$equipo->nombre}}">
                </div>
                <div class="form-group">
                    <label for="ciudad">Ciudad</label>
                    <input type="text" name="ciudad" id="ciudad" class="form-control" value="{{$equipo->ciudad}}">
                </div>
                <div class="form-group">
                    <label for="imagenUrl">Imagen</label>
                    <input id="imagenUrl" name="imagenUrl" type="file" class="form-control @error('descripcion') is-invalid @enderror" value="{{$equipo->imagenUrl}}">
                    <div id="message" class="text-muted">No se ha seleccionado ninguna imagen. La imagen que estaba antes se mantendrá.</div>
                    @error('imagenUrl')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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
                <a href="/equipos" class ="btn btn-primary">Cancelar</a>    
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
</div>

<script>
    function showMessage(input) {
        var message = document.getElementById('message');
        if (input.value) {
            message.style.display = 'none';
        } else {
            message.style.display = 'block';
        }
    }
</script>

@endsection('contenido')