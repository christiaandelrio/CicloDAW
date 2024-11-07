<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invitacion;
use App\Models\User;
use Illuminate\Support\Facades\Auth; // Agrega esta línea

class InvitacionController extends Controller
{
    /**
     * Procesa la respuesta a una invitación.
     */
    public function responder(Request $request, $id)
    {
        $invitacion = Invitacion::findOrFail($id);
    
        if ($invitacion->receiver_id !== Auth::id()) {
            return redirect()->route('perfil')->with('error', 'No tienes permiso para responder a esta invitación.');
        }
    
        if ($request->input('accion') === 'aceptar') {
            $invitacion->status = 'aceptada';
            $invitacion->save();
    
            // Relacionar los usuarios en una tabla de 'gastos compartidos'
            // Crear una relación en la base de datos o vincular los gastos en este punto
        } elseif ($request->input('accion') === 'rechazar') {
            $invitacion->status = 'rechazada';
            $invitacion->save();
        }
    
        return redirect()->route('perfil')->with('message', 'La invitación ha sido respondida.');
    }
    

    public function enviar(Request $request)
    {
        // Validar que el email es requerido y es un correo válido
        $request->validate([
            'email' => 'required|email'
        ]);

        // Encontrar el usuario con el email introducido
        $receiver = User::where('email', $request->email)->first();

        if (!$receiver) {
            return redirect()->route('perfil')->with('error', 'Usuario no encontrado.');
        }

        // Verificar que el usuario no se esté invitando a sí mismo
        if ($receiver->id == Auth::id()) {
            return redirect()->route('perfil')->with('error', 'No puedes invitarte a ti mismo.');
        }

        // Crear la invitación
        Invitacion::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $receiver->id,
            'status' => 'pendiente'
        ]);

        return redirect()->route('perfil')->with('message', 'Invitación enviada con éxito.');
    }
}

