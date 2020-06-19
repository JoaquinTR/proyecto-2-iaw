<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'image';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre_vista', 'juego_id', 'imagen'
    ];

    /**
     * Obtener el juego al que pertenece esta imágen.
     */
    public function juego()
    {
        return $this->belongsTo('App\juego');
    }
}
