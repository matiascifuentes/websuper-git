<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table =  'pedidos';

    protected $fillable = ['subtotal','user_id','ip'];
}
  