<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleCanasta extends Model
{
    //
    protected $table = 'detalle_canasta';
    //	PK no tiene como nombre 'id'
    protected $primaryKey = ['cod_c','cod_p'];
    //	PK no es autoincrementable
    public $incrementing=false;
    //	Tabla no utiliza timestamp
    public $timestamps = false;
}
