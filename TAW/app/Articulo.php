<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    //
    protected $table = 'articulos';
    protected $primaryKey = 'idarticulo';
    protected $fillable=[
        'idcategoria','codigo','nombre','precio_venta','stock','descripcion', 'condicion'
    ];
}
