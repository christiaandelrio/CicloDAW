@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="login-container">
    <div class="login-card">
        <div class="login-card-header">Iniciar Sesión</div>
        <div class="login-card-body">
            <form action="/login" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" name="email" class="form-input" required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" class="form-input" required>
                </div>
                <button type="submit" class="btn-submit">Iniciar Sesión</button>
            </form>
        </div>
    </div>
</div>
@endsection

