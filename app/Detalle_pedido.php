<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle_pedido extends Model
{
    protected $table = 'detalle_pedidos';
    protected $fillable = ['precio', 'cantidad','product_id','pedido_id'];

    public $timestamps = false;
}
