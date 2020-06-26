<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Juego extends Model
{
    protected $table = 'juego';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre', 'genero','fecha_lanzamiento', 'descripcion','plataforma','editor','desarrollador','puntaje','cant_calificaciones','rating'
    ];

    /**
     * Obtener las calificaciones que corresponden a este juego.
     */
    public function calificaciones()
    {
        return $this->hasMany('App\calificacion');
    }

    /**
     * Obtener las imágenes que fueron cargadas a este juego.
     */
    public function imagenes()
    {
        return $this->hasMany('App\Image');
    }
}
