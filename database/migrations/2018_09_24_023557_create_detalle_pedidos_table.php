<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('precio');
            $table->integer('cantidad')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')
                ->references('id')
                ->on('productos')
                ->onDelete('cascade');
            $table->integer('pedido_id')->unsigned();
            $table->foreign('pedido_id')
                ->references('id')
                ->on('pedidos')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_pedidos');
    }
}
