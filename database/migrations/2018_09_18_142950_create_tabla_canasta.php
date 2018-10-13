<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablaCanasta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Realizar cambio
        Schema::create('canastas',function(Blueprint $tabla){
            $tabla->increments("id");   //PK por defecto al ser autoincrementable
            $tabla->string('nombre');
            $tabla->string('descripcion');

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
        //Revertir cambio
        Schema::drop('canastas');
    }
}
