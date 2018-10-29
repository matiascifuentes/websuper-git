<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntregaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrega', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pedido_id')->unsigned();
            $table->foreign('pedido_id')
                ->references('id')
                ->on('pedidos');
            $table->integer('repartidor_id')->unsigned();
            $table->foreign('repartidor_id')
                ->references('id')
                ->on('repartidores');
            $table->string('estado');
            $table->timestamps(); //Fecha de creacion y de ultima modificacion.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entrega');
    }
}
