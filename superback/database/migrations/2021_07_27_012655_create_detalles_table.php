<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->double("precio",11,2);
            $table->integer("cantidad");
            $table->double("subtotal",11,2);
//            $table->unsignedBigInteger('cliente_id')->default(1);
//            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->unsignedBigInteger('user_id')->default(1);
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('agencia_id')->default(1);
            $table->foreign('agencia_id')->references('id')->on('agencias');
            $table->unsignedBigInteger('producto_id')->default(1);
            $table->foreign('producto_id')->references('id')->on('productos');
            $table->unsignedBigInteger('pedido_id')->default(1);
            $table->foreign('pedido_id')->references('id')->on('pedidos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalles');
    }
}
