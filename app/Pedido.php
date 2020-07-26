<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedido';
    protected $primaryKey = 'id';

    protected $fillable = [
        'users_id','nombre', 'genero','fecha_lanzamiento', 'descripcion','plataforma','editor','desarrollador'
    ];

    /**
     * Obtener las calificaciones que corresponden a este juego.
     */
    public function users()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Obtener las imágenes que fueron cargadas a este juego.
     */
    public function juego()
    {
        return $this->belongsTo('App\juego');
    }
}
