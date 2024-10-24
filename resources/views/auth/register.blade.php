@extends('layouts.app')

@section('title', 'Registro')

@section('content')
<div class="register-container" style="display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #F2F4F5;">
    <div class="register-card" style="background-color: #FFFFFF; padding: 40px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); width: 100%; max-width: 500px;">
        <h2 style="text-align: center; color: #3B4013; margin-bottom: 20px;">Registrarse</h2>
        <form action="/register" method="POST" style="display: flex; flex-direction: column; gap: 20px;">
            @csrf
            <div class="form-group" style="display: flex; flex-direction: column;">
                <label for="name" style="color: #0D0D0D;">Nombre</label>
                <input type="text" name="name" class="form-input" required style="padding: 10px; border-radius: 5px; border: 1px solid #BFD1C9; background-color: #F2EFDF; color: #3B4013;">
            </div>

            <div class="form-group" style="display: flex; flex-direction: column;">
                <label for="email" style="color: #0D0D0D;">Correo Electrónico</label>
                <input type="email" name="email" class="form-input" required style="padding: 10px; border-radius: 5px; border: 1px solid #BFD1C9; background-color: #F2EFDF; color: #3B4013;">
            </div>

            <div class="form-group" style="display: flex; flex-direction: column;">
                <label for="password" style="color: #0D0D0D;">Contraseña</label>
                <input type="password" name="password" class="form-input" required style="padding: 10px; border-radius: 5px; border: 1px solid #BFD1C9; background-color: #F2EFDF; color: #3B4013;">
            </div>

            <button type="submit" class="btn-submit" style="background-color: #4CAF50; color: #FFFFFF; padding: 10px; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s;">
                Registrarse
            </button>
        </form>
    </div>
</div>
@endsection


