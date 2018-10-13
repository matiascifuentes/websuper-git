<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablaHistorialPrecio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('historial_precio',function(Blueprint $tabla){
        $tabla->integer('id_prod');   //PK por defecto al ser autoincrementable
        $tabla->date('fecha');
        $tabla->integer('precio');

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
        Schema::drop('historial_precio');
    }
}
