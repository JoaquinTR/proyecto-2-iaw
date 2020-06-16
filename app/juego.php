<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class juego extends Model
{
    protected $table = 'juego';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre', 'imagen', 'genero','fecha_lanzamiento', 'descripcion','plataforma','editor','desarrollador'
    ];

    /**
     * Obtener las calificaciones que corresponden a este juego.
     */
    public function calificaciones()
    {
        return $this->hasMany('App\calificacion');
    }
}
