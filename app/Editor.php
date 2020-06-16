<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Editor extends Model
{
    protected $table = 'editor';

    protected $fillable = ['nombre'];
}
