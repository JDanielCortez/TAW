<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatallesIngresoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datalles_ingreso', function (Blueprint $table) {
            $table->increments('iddetalle_ingreso');
            $table->unsignedInteger('idingreso');
            $table->unsignedInteger('idarticulo');
            $table->integer('cantidad');
            $table->decimal('precio_compra',11,2);

            $table->timestamps();

            $table->foreign('idingreso')->references('idingreso')->on('ingresos');
            $table->foreign('idarticulo')->references('idarticulo')->on('articulos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datalles_ingreso');
    }
}
