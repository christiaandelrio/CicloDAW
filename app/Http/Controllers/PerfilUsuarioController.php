<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class PerfilUsuarioController extends Controller
{
    public function show()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();
        
        // Pasar los datos del usuario a la vista
        return view('perfil.show', compact('user'));
    }
}
