<?php

namespace App;

#use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Entrega extends Authenticatable
{
    //
    protected $table = 'entrega';
    protected $fillable = ['pedido_id','repartidor_id'];
}
