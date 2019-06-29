<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            
            $table->unsignedInteger('idpersona');
            $table->unsignedInteger('idrol');
            $table->string('clave',50);
            $table->boolean('estado')->default(0);
            $table->timestamps();

            $table->foreign('idpersona')->references('idpersona')->on('personas');
            $table->foreign('idrol')->references('idrol')->on('roles');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
