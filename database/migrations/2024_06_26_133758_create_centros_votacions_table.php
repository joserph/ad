<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centros_votacions', function (Blueprint $table) {
            $table->id();

            $table->integer('cod_centro');
            $table->integer('tipo');
            $table->integer('cod_estado');
            $table->integer('cod_municipio');
            $table->integer('cod_parroquia');
            $table->string('nombre_centro');
            $table->string('direccion_centro');
            $table->integer('centro_nuevo');

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
        Schema::dropIfExists('centros_votacions');
    }
};
