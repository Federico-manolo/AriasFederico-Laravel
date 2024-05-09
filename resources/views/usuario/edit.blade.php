@extends('layouts.plantillabase')

@section('contenido')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Editemos al usuario {{$usuario->id}}</h1>
        </div>
        <div class="card-body">
            <form action="/usuarios/{{$usuario->id}}" method="POST" class="form">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{$usuario->name}}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{$usuario->email}}">
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
                <a href="/usuarios" class ="btn btn-primary">Cancelar</a>    
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
</div>

@endsection('contenido')