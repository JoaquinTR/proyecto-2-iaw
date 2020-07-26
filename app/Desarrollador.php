<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Desarrollador extends Model
{
    protected $table = 'desarrollador';
    protected $primaryKey = 'id';

    protected $fillable = ['nombre'];
}
