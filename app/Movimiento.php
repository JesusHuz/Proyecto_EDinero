<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{

    protected $table = 'bdmovimientos';

    protected $fillable = [
        'tipo',
        'movimiento_dato',
        'categoria_id',
        'descripcion',
        'money'

    ];//campos para llenar de manera masiba

    protected $dates = ['movimiento_dato'];//para convertirla en fecha entendible como en la clase prueba6

    public function getMoneyDecimalAttribute()//si se pone de ultimo attribute sera un atributo que tendra pero no se guardara en la base de datos
    {
        return $this->attributes['money'] / 100;
    }
    //relacion con categoria
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);//el movimiento pertenece al usuario ..
    }

    public function user()
    {
        return $this->belongsTo(User::class);//el movimiento pertenece al usuario ..
    }
}
