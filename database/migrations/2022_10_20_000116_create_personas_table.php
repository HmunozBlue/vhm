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
        Schema::create('personas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('primerNombre', 50);
            $table->string('segundoNombre', 100);
            $table->string('primerApellido', 50);
            $table->string('segundoApellido', 50);
            $table->string('genero', 10);
            $table->date('fechaNacimiento');
            $table->string('CUI', 30);
            $table->string('NIT', 10);
            $table->string('pais', 60);
            $table->string('departamento', 80);
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
        Schema::dropIfExists('personas');
    }
};
