<!-- resources/views/perfil/configuracion.blade.php -->
@extends('layouts.app')

@section('title', 'Configuración')

@section('content')
<div class="container mt-4">
    <h2>Configuración</h2>
    <form class="formulario" action="{{ route('perfil.configuracion.update') }}" method="POST">
        @csrf
        <!-- Notificaciones -->
        <div class="formulario-grupo">
            <label class="formulario-label" for="notifications">Notificaciones</label>
            <select name="notifications" id="notifications" class="formulario-select">
                <option value="enabled" {{ auth()->user()->notifications ? 'selected' : '' }}>Activadas</option>
                <option value="disabled" {{ !auth()->user()->notifications ? 'selected' : '' }}>Desactivadas</option>
            </select>
        </div>

        <!-- Tema Oscuro -->
        <div class="formulario-grupo">
            <label class="formulario-label" for="dark_mode">Tema Oscuro</label>
            <select name="dark_mode" id="dark_mode" class="formulario-select">
                <option value="enabled" {{ auth()->user()->dark_mode ? 'selected' : '' }}>Activado</option>
                <option value="disabled" {{ !auth()->user()->dark_mode ? 'selected' : '' }}>Desactivado</option>
            </select>
        </div>

        <button type="submit" class="boton-enviar">Guardar cambios</button>
    </form>
</div>
@endsection
