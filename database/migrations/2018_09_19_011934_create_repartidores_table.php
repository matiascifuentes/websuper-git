<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepartidoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repartidores', function (Blueprint $tabla) {
            $tabla->increments('id');
            $tabla->string('nombre');
            $tabla->integer('edad');
            $tabla->string('direccion');
            $tabla->text('correo');
            $tabla->string('fecha_ingreso');
            $tabla->string('situacion');
            $tabla->string('disponibilidad');
            
            $tabla->timestamps(); //Fecha de creacion y de ultima modificacion.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repartidores');
    }
}
