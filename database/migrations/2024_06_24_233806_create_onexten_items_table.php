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
        Schema::create('onexten_items', function (Blueprint $table) {
            $table->id();

            $table->string('item')->nullable();
            $table->string('cedula')->nullable();
            $table->string('nombre')->nullable();
            $table->string('apellido')->nullable();
            $table->string('num_telefono')->nullable();
            $table->string('direccion')->nullable();
            $table->string('centro_votacion')->nullable();
            $table->foreignId('onexten_id')->references('id')->on('onextens');

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
        Schema::dropIfExists('onexten_items');
    }
};
