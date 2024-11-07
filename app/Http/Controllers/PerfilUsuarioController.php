<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use App\Models\GastoCompartido;
use App\Models\Invitacion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PerfilUsuarioController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        // Obtener invitaciones pendientes
        $invitacionesPendientes = Invitacion::where('receiver_id', $user->id)
                                             ->where('status', 'pendiente')
                                             ->get();

        // Obtener IDs de usuarios con quienes se comparten gastos
        $sharedWithUserIds = GastoCompartido::where('user_id', $user->id)
                                            ->orWhere('shared_with', $user->id)
                                            ->pluck('shared_with')
                                            ->merge(
                                                GastoCompartido::where('shared_with', $user->id)->pluck('user_id')
                                            )
                                            ->unique()
                                            ->toArray();

        // Incluir el usuario actual en la lista de usuarios de gastos compartidos
        $sharedWithUserIds[] = $user->id;

        // Obtener los gastos compartidos de los usuarios en sharedWithUserIds
        $gastosCompartidos = Gasto::whereIn('user_id', $sharedWithUserIds)->get();

        return view('perfil.show', compact('user', 'invitacionesPendientes', 'gastosCompartidos'));
    }
}





