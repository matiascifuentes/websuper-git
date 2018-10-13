<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablaDetalleCanasta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('detalle_canasta',function(Blueprint $tabla){
            $tabla->integer('cod_c')->unsigned();
            $tabla->integer('cod_p')->unsigned();
            $tabla->integer('cantidad');

            $tabla->foreign('cod_c')->references('id')->on('canastas')->onDelete('cascade');
            $tabla->foreign('cod_p')->references('id')->on('productos')->onDelete('cascade');
            $tabla->primary(['cod_c','cod_p']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('detalle_canasta');
    }
}
