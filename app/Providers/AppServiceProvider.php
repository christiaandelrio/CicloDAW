<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Invitacion; // Importar la clase Invitacion

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Compartir el modo oscuro y las invitaciones pendientes con todas las vistas
        View::composer('*', function ($view) {
            $darkMode = Auth::check() ? Auth::user()->dark_mode : false;
            $view->with('darkMode', $darkMode);

            $invitacionesPendientes = collect(); // Colección vacía por defecto
            $invitacionesCount = 0; // Contador por defecto

            if (Auth::check()) {
                $invitacionesPendientes = Invitacion::where('receiver_id', Auth::id())
                    ->where('status', 'pendiente')
                    ->get(); // Recuperar las invitaciones pendientes como colección

                $invitacionesCount = $invitacionesPendientes->count(); // Contar las invitaciones
            }

            // Pasar ambos valores a las vistas
            $view->with('invitacionesPendientes', $invitacionesPendientes);
            $view->with('invitacionesCount', $invitacionesCount);
        });
    }
}
