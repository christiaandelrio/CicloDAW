@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="contenedor-formulario">
<div class="formulario">
<!-- <div class="card-body"> -->
<h2>Iniciar Sesión</h2>
<form action="{{ route('login') }}" method="POST">
@csrf
        <div class="formulario-grupo">
            <label for="email" class="formulario-label">Correo Electrónico</label>  
            <input type="email" name="email" class="formulario-input" required>
        </div>
        <div class="formulario-grupo">
            <label for="password">Contraseña</label>
            <input type="password" name="password" class="formulario-input" required>
        </div>
        <button type="submit" class="boton-enviar">Iniciar Sesión</button>
    </form>

<!-- </div> -->
</div>
<a href="{{ route('index') }}">Volver al Inicio</a>

</div>
@endsection

