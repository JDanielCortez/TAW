<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->increments('idventa');
            $table->unsignedInteger('idcliente');
            $table->unsignedInteger('idusuario');
            $table->string('tipo_comprobante',20);
            $table->string('serie_comprobante',7);
            $table->string('num_comprobante',10);
            $table->dateTime('fecha_hora');
            $table->decimal('impuesto',4,2);
            $table->decimal('total_venta',11,2);
            $table->string('estado',20);

            $table->timestamps();

            $table->foreign('idcliente')->references('idpersona')->on('personas');
            $table->foreign('idusuario')->references('idpersona')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
}
