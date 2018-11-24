<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'bdcategorias';
    protected $fillable = ['name'];
}
