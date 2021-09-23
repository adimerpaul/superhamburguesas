<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion')->default('')->nullable();
            $table->double('precio',11,2)->default(20)->nullable();
            $table->integer('stock')->default(100)->nullable();
            $table->integer('star')->default(5);
//            $table->boolean('postre')->default(false);
//            $table->boolean('acompanamiento')->default(false);
//            $table->boolean('gaseoso')->default(false);
            $table->string('tipo')->default('PRODUCTO');
//            $table->string('codigo')->default('');
//            $table->string('color');
            $table->string('imagen')->default('a.jpg')->nullable();
//            $table->string('imagen2');
            $table->unsignedBigInteger('rubro_id')->default(1);
            $table->foreign('rubro_id')->references('id')->on('rubros');
            $table->unsignedBigInteger('agencia_id')->default(1);
            $table->foreign('agencia_id')->references('id')->on('agencias');
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
        Schema::dropIfExists('productos');
    }
}
