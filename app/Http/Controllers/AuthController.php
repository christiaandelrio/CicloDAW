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
    
        // Redirigir al dashboard con un mensaje
        return redirect()->route('dashboard')->with('mensaje_popup', 'Te has registrado correctamente, bienvenido!');
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
            $nombreUsuario = auth()->user()->name; //Tengo que obtenerlo aquí dentro para que no sea null

            return redirect()->route('dashboard')->with('mensaje_popup', 'Bienvenido, '.$nombreUsuario.'!');
        }
    
        // Si falla, redirigir de nuevo con un mensaje de error
        return back()->with('mensaje_popup', 'Credenciales incorrectas.');
    }
    
    //Cerrar sesión
    public function logout()
    {
        auth()->logout();
        return redirect('/')->with('mensaje_popup', 'Has cerrado sesión correctamente.');
    }
    

    
}


