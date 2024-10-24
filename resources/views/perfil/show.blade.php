@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')
<div class="py-4">
    <div class="card shadow-sm" style="background-color: #FFFFFF; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2); margin: 0 auto; max-width: 600px;">
        <div class="card-body">
            <h2 class="card-title" style="color: #3B4013; text-align: center;">Perfil de Usuario</h2>
            <div class="form-group">
                <label style="color: #0D0D0D;">Nombre:</label>
                <p>{{ $user->name }}</p>
            </div>
            <div class="form-group">
                <label style="color: #0D0D0D;">Email:</label>
                <p>{{ $user->email }}</p>
            </div>
            <!-- Aquí puedes agregar más campos según lo que quieras mostrar -->
            <a href="{{ route('dashboard') }}" class="btn btn-primary">Volver al Dashboard</a>
        </div>
    </div>
</div>
@endsection
