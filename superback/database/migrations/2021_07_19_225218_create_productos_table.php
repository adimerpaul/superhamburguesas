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
            $table->string('descripcion');
            $table->double('precio',11,2);
            $table->integer('stock');
            $table->boolean('extra')->default(false);
            $table->boolean('postre')->default(false);
            $table->boolean('acompanamiento')->default(false);
            $table->boolean('gaseoso')->default(false);
            $table->string('tipo')->default('PRODUCTO');
            $table->string('codigo');
            $table->string('imagen');
            $table->unsignedBigInteger('rubro_id');
            $table->foreign('rubro_id')->references('id')->on('rubros');
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
