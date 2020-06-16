<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class calificacion extends Model
{
    protected $table = 'calificacion';
    protected $primaryKey = 'id';

    //tipo = jugador o no
    protected $fillable = [
        'autor','id_juego', 'descripcion','reseña','puntaje','tipo'
    ];

    /**
     * Obtener el juego al que pertenece esta calificacion.
     */
    public function juego()
    {
        return $this->belongsTo('App\juego');
    }
}
