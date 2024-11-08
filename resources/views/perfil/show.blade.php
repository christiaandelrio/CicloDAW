@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')
<div class="formulario">
    <div class="card-body">
    <h2 class="card-title">Mi perfil</h2>
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
            <div  class="formulario-grupo">
                <h4>Invitaciones Pendientes</h4>
                @if($invitacionesPendientes->isEmpty())
                    <p>No tienes invitaciones pendientes.</p>
                @else
                    <ul>
                        @foreach($invitacionesPendientes as $invitacion)
                            <li>
                                Invitación de {{ $invitacion->sender->name }} para compartir gastos.
                                <form action="{{ route('invitaciones.responder', $invitacion->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" name="accion" value="aceptar" class="boton-enviar">Aceptar</button>
                                    <button type="submit" name="accion" value="rechazar" class="boton-eliminar">Rechazar</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <a href="{{ route('dashboard') }}" class="boton-enviar">Volver al Dashboard</a>
        </div>
    <div class="formulario">
    <h4>Enviar Invitación</h4>
    <form action="{{ route('invitaciones.enviar') }}" method="POST">
        @csrf
        <div class="formulario-grupo">
            <label for="email">Correo electrónico del usuario a invitar:</label>
            <input type="email" name="email" id="email" class="formulario-input" required>
        </div>
        <button type="submit" class="boton-enviar">Enviar Invitación</button>
    </form>
</div>


</div>
@endsection

