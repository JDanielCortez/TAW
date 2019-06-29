<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallesVentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles_venta', function (Blueprint $table) {
            $table->increments('iddetalle_venta');
            $table->unsignedInteger('idventa');
            $table->unsignedInteger('idarticulo');
            $table->integer('cantidad');
            $table->decimal('precio_venta',11,2);
            $table->decimal('descuento',11,2);

            $table->timestamps();


            $table->foreign('idventa')->references('idventa')->on('ventas');
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
        Schema::dropIfExists('detalles_venta');
    }
}
