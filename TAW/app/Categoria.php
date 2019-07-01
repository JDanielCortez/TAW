<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';
    protected $primaryKey = 'id';
    protected $fillable=[
        'nombre','descripcion','condicion'
    ];
}
