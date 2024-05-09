@extends('layouts.plantillabase')
@section('css')
    <link rel="stylesheet" href={{ Vite::asset("resources/css/dashboard.css") }}  >
@endsection
@section('contenido')

<div class="row">
  <div class="col-md-3">
    <div class="carta">
      <div class="carta-body">
        <h5 class="carta-title">Cartas</h5>
        <p class="carta-text">Cartas físicas de jugadores de la NBA.</p>
        <a href="/cartas" class="btn btn-primary carta-btn">Administrar</a>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="jugadores">
      <div class="jugadores-body">
        <h5 class="jugadores-title">Jugadores</h5>
        <p class="jugadores-text">Información de los jugadores de la NBA.</p>
        <a href="/jugadores" class="btn btn-primary jugadores-btn">Administrar</a>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="usuarios">
      <div class="usuarios-body">
        <h5 class="usuarios-title">Usuarios</h5>
        <p class="usuarios-text">Información de los usuarios del sistema.</p>
        <a href="/usuarios" class="btn btn-primary usuarios-btn">Administrar</a>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="equipos">
      <div class="equipos-body">
        <h5 class="equipos-title">Equipos</h5>
        <p class="equipos-text">Información de los equipos de la NBA.</p>
        <a href="/equipos" class="btn btn-primary equipos-btn">Administrar</a>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="pedidos">
      <div class="pedidos-body">
        <h5 class="pedidos-title">Pedidos</h5>
        <p class="pedidos-text">Información de los pedidos realizados.</p>
        <a href="/pedidos" class="btn btn-primary pedidos-btn">Administrar</a>
      </div>
    </div>
  </div>
</div>
@endsection
