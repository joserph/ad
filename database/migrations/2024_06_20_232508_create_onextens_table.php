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
        Schema::create('onextens', function (Blueprint $table) {
            $table->id();

            $table->string('responsable');
            $table->string('telefono');
            $table->string('seccional');
            $table->string('municipio');
            $table->string('parroquia');
            $table->string('sector');
            
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
        Schema::dropIfExists('onextens');
    }
};
