<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->increments('idarticulo');
            $table->unsignedInteger('idcategoria');
            $table->string('codigo',50);
            $table->string('nombre',100);
            $table->decimal('precio_venta',11,2);
            $table->integer('stock');
            $table->string('descripcion',256);
            $table->boolean('condicion')->default(1);

            $table->timestamps();

            $table->foreign('idcategoria')->references('id')->on('categorias');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articulos');
    }
}
