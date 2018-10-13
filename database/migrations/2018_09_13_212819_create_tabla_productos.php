<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablaProductos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Realizar cambio
        Schema::create('productos',function(Blueprint $tabla){
            $tabla->increments("id");
            $tabla->string('titulo');
            $tabla->integer('precio');
            $tabla->string('categoria');
            $tabla->text('descripcion');
            $tabla->string('supermercado');
            $tabla->text('img');
            $tabla->text('url');

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
        Schema::drop('productos');
    }
}
