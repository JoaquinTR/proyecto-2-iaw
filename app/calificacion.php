<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class calificacion extends Model
{
    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'ultima_actualizacion';

    protected $table = 'calificacion';
    protected $primaryKey = 'id';

    //tipo = jugador o no
    protected $fillable = [
        'autor', 'id_juego', 'descripcion','puntaje', 'tipo'
    ];

    /**
     * Obtener el juego al que pertenece esta calificacion.
     */
    public function juego()
    {
        return $this->belongsTo('App\juego');
    }
}
