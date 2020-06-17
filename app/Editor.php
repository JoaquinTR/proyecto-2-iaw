<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Editor extends Model
{
    protected $table = 'editor';
    protected $primaryKey = 'id';

    protected $fillable = ['nombre'];
}
