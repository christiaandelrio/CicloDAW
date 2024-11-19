@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')
<div class="perfil-formulario">
<h2>Mi perfil</h2>

    <div class="formulario">
        @if($user)
            <div class="formulario-grupo">
                <label class="formulario-label">Nombre:</label>
                <p>{{ $user->name }}</p>
            </div>
            <div class="formulario-grupo">
                <label class="formulario-label">Email:</label>
                <p>{{ $user->email }}</p>
            </div>
        @else
            <p>Usuario no encontrado.</p>
        @endif

        <!-- Sección de Invitaciones Pendientes -->
        <div class="formulario-grupo">
            <h4>Invitaciones Pendientes</h4>
            @if($invitacionesPendientes->isEmpty())
                <p>No tienes invitaciones pendientes.</p>
            @else
                <ul>
                    @foreach($invitacionesPendientes as $invitacion)
                        <li>
                        <form action="{{ route('invitaciones.responder', $invitacion->id) }}" method="POST" style="display: inline-flex; align-items: center;">
                        @csrf
                            Invitación de {{ $invitacion->sender->name }} para compartir gastos.                                <button type="submit" name="accion" value="aceptar" class="boton-icono">
                                    <i class="fa-solid fa-circle-check"></i>
                                </button>
                                <button type="submit" name="accion" value="rechazar" class="boton-icono">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                </button>


                            </form>
                        </li>
                    @endforeach
                </ul>
            @endif

            <h4>Enviar Invitación</h4>
            <form action="{{ route('invitaciones.enviar') }}" method="POST">
                @csrf
                <div class="formulario-grupo">
                    <label for="email" class="formulario-label">Correo electrónico del usuario a invitar:</label>
                    <input type="email" name="email" id="email" class="formulario-input" required>
                </div>
                <button type="submit" class="boton-enviar">Enviar Invitación</button>
            </form>
        </div>
    </div>
</div>
@endsection


