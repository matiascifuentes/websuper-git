<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class repartidor extends Authenticatable
{
    //
    use Notifiable;
     protected $table = 'repartidores';
}
