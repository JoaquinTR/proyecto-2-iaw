<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    protected $table = 'calificacion';
    protected $primaryKey = 'id';

    //tipo = jugador o no
    protected $fillable = [
        'users_id','juego_id', 'descripcion','reseña','puntaje','tipo'
    ];

    /**
     * Obtener el juego al que pertenece esta calificacion.
     */
    public function juego()
    {
        return $this->belongsTo('App\juego');
    }

    /**
     * Obtener el usuario que creó esta calificacion.
     */
    public function users()
    {
        return $this->belongsTo('App\User');
    }
}
