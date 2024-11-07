<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitacion extends Model
{
    use HasFactory;

    // Especifica el nombre correcto de la tabla
    protected $table = 'invitaciones';

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'status',
    ];

    // Relaciones
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    
}
