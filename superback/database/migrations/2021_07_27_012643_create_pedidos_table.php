<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->date("fecha");
            $table->time("hora");
            $table->string("ci")->nullable()->default('');
            $table->string("nombre")->nullable()->default('');
            $table->string("direccion")->nullable()->default('');
            $table->string("lat")->nullable()->default('');
            $table->string("lng")->nullable()->default('');
            $table->string("estado")->default('ACTIVO');
            $table->string("telefono")->nullable()->default('');
            $table->string("factura")->nullable()->default('');

//            $table->string("nombrefactura");
            $table->double("total",11,2);
//            $table->unsignedBigInteger('agencia_id')->default(1);
//            $table->foreign('agencia_id')->references('id')->on('agencias');
            $table->unsignedBigInteger('user_id')->default(1);
            $table->foreign('user_id')->references('id')->on('users');
//            $table->unsignedBigInteger('cliente_id')->default(1);
//            $table->foreign('cliente_id')->references('id')->on('clientes');
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
        Schema::dropIfExists('pedidos');
    }
}
