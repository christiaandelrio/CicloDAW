@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')
<div class="py-4">
    <div class="card shadow-sm" style="background-color: #FFFFFF; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2); margin: 0 auto; max-width: 600px;">
        <div class="card-body">
            <h2 class="card-title" style="color: #3B4013; text-align: center;">Mi Perfil</h2>
            
            @if($user)
                <div class="form-group">
                    <label style="color: #0D0D0D;">Nombre:</label>
                    <p>{{ $user->name }}</p>
                </div>
                <div class="form-group">
                    <label style="color: #0D0D0D;">Email:</label>
                    <p>{{ $user->email }}</p>
                </div>
            @else
                <p>Usuario no encontrado.</p>
            @endif

            <!-- Sección de Invitaciones Pendientes -->
            <div class="mt-4">
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
                                    <button type="submit" name="accion" value="aceptar" class="btn btn-sm btn-success">Aceptar</button>
                                    <button type="submit" name="accion" value="rechazar" class="btn btn-sm btn-danger">Rechazar</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <a href="{{ route('dashboard') }}" class="btn btn-primary">Volver al Dashboard</a>
        </div>
        <div class="mt-4">
    <h4>Enviar Invitación</h4>
    <form action="{{ route('invitaciones.enviar') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Correo electrónico del usuario a invitar:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Enviar Invitación</button>
    </form>
</div>


</div>
@endsection

