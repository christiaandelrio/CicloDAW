<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GastoCompartido extends Model
{
    use HasFactory;

    protected $table = 'gastos_compartidos'; 

    protected $fillable = [
        'gasto_id',
        'user_id',
        'shared_with',
        'porcentaje',
        'created_at',
        'updated_at',
    ];

    // Define la relación con el modelo Gasto
    public function gasto()
    {
        return $this->belongsTo(Gasto::class, 'gasto_id');
    }

    // Define la relación con el modelo User para el usuario con quien se comparte
    public function sharedWithUser()
    {
        return $this->belongsTo(User::class, 'shared_with');
    }
}



