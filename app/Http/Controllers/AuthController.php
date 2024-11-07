<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Crear un nuevo usuario
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        // Iniciar sesión automáticamente después de registrarse
        auth()->login($user);

        // Redirigir al dashboard
        return redirect()->route('dashboard')->with('success', 'Usuario registrado exitosamente.');
    }

    // Iniciar sesión
    public function login(Request $request)
    {
        // Validar los datos del formulario de login
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Intentar iniciar sesión
        if (auth()->attempt($credentials)) {
            return redirect()->route('dashboard')->with('success', 'Inicio de sesión exitoso.');
        }
        

        // Si falla, redirigir de nuevo con un mensaje de error
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ]);
    }

    // Cerrar sesión
    public function logout()
    {
        auth()->logout();
        return redirect('/')->with('success', 'Has cerrado sesión correctamente.'); // Redirigir a la página principal
    }

    
}


