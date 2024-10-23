<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Modelo para manejar los datos de la tabla Gastos
 */
class Gasto extends Model
{
    use HasFactory;

    protected $fillable = [ //Creo un array rellenable con los campos de la tabla
        'user_id','nombre_gasto','tipo','valor','fecha','descripcion','icono','categoria'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * Método para obtener todos los gastos de un usuario
     */
    public static function obtenerGastosUsuario($userId){
        return self::where('user_id',$userId)->get();
    }

    /**
     * Método para crear un gasto
     * @param $data, array de Datos del gasto
     * @return Gasto
     */
    public static function crearGasto($data){
        return self::create($data);
    }

    /**
     * Método para actualizar un gasto
     * @param int $id del gasto
     * @param array $data
     * @return Gasto
     */
    public static function actualizarGasto($id,$data){
        $gasto = self::findOrFail($id);
        $gasto->update($data);
        return $gasto;
    }

    /**
     * Método para eliminar un gasto
     * @param int $id
     * @return bool
     */
    public static function eliminarGasto($id){
        $gasto = self::findOrFail($id);
        return $gasto->delete();
    }
}
