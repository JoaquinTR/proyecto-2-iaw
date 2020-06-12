<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class juego extends Model
{
    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'ultima_actualizacion';

    protected $table = 'juego';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre', 'imagen', 'genero','fecha_lanzamiento', 'descripcion','url_sitio','plataforma'
    ];

    /**
     * Obtener las calificaciones que corresponden a este juego.
     */
    public function calificaciones()
    {
        return $this->hasMany('App\calificacion');
    }
}
