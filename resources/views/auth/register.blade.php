@extends('layouts.app')

@section('title', 'Registro')

@section('content')
<div class="py-4">
<div class="formulario">
<div class="card-body">
<h2 class="card-title">Registrarse</h2>
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
                <input type="password" name="password" class="formulario-input" required>
            </div>

            <button type="submit" class="boton-enviar">Registrarse</button>
        </form>
    </div>
</div>
<a href="{{ route('index') }}">Volver al Inicio</a>

</div>
@endsection


