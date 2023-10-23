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
        Schema::create('tours', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('guies')->unsigned()->nullable();
            $table->decimal('amount', 8,2)->nullable();
            $table->integer('tipeTour')->unsigned()->nullable();
            $table->integer('vehicleId')->unsigned()->nullable();
            $table->integer('boxCarId')->unsigned();
            $table->integer('driverId')->unsigned()->nullable();
            $table->integer('asistantId')->unsigned();
            $table->integer('asistantId1')->unsigned();
            $table->integer('asistantId2')->unsigned();
            $table->string('comment', 100)->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('tours');
    }
};
