@extends('layouts.app')

@section('title', 'Registro')

@section('content')

<div class="contenedor-formulario">
<div class="formulario">
<h2>Registrarse</h2>
<form action="{{ route('register') }}" method="POST">
@csrf
            <div class="formulario-grupo">
                <label for="name" class="formulario-label">Nombre</label>
                <input type="text" name="name" class="formulario-input" required>
            </div>

            <div class="formulario-grupo">
                <label for="email" class="formulario-label">Correo Electrónico</label>
                <input type="email" name="email" class="formulario-input" required>
            </div>

            <div class="formulario-grupo">
                <label for="password" class="formulario-label">Contraseña</label>
                <input type="password" name="password" class="formulario-input" required minlength="8">
            </div>

            <button type="submit" class="boton-enviar">Registrarse</button>
        </form>
    </div>

<a href="{{ route('index') }}">Volver al Inicio</a>
</div>
</div>
@endsection


