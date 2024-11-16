<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'tutorial_visto', 
        'dark_mode', 
        'notifications', 
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'tutorial_visto' => 'boolean', 
        'dark_mode' => 'boolean', 
    ];

    public function sharedGastos()
    {
        return $this->hasMany(Gasto::class, 'shared_with_user_id');
    }

    public function marcarTutorialVisto()
    {
        try {
            $user = Auth::user();
    
            if (!$user) {
                Log::error('Usuario no autenticado al intentar marcar tutorial.');
                return response()->json(['success' => false, 'error' => 'Usuario no autenticado'], 403);
            }
    
            $user->tutorial_visto = true;
            $user->save();
    
            Log::info('Tutorial marcado como visto para el usuario ID: ' . $user->id);
    
            return response()->json(['success' => true]);
    
        } catch (\Exception $e) {
            Log::error('Error al marcar tutorial: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => 'Error interno del servidor'], 500);
        }
    }
}
