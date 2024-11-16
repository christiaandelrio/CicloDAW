<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerfilConfiguracionController extends Controller
{
    public function index()
    {
        return view('perfil.configuracion');
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        // Actualizar configuración
        $user->notifications = $request->notifications === 'enabled';
        $user->dark_mode = $request->dark_mode === 'enabled';
        $user->save();

        return redirect()->route('perfil.configuracion')->with('success', 'Configuración actualizada con éxito.');
    }
}