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
        Schema::create('boxcars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('use', 100)->nullable();
            $table->string('tipe', 100)->nullable();
            $table->string('vin', 100)->nullable();
            $table->string('chasis', 100)->nullable();
            $table->string('color', 50)->nullable();
            $table->string('carPlate', 100)->nullable();
            $table->string('brand', 100)->nullable();
            $table->string('model', 100)->nullable();
            $table->string('serie', 100)->nullable();
            $table->string('tonnage', 100)->nullable();
            $table->string('axles', 50)->nullable();
            $table->string('name', 100)->nullable();
            $table->boolean('active')->nullable()->default(true);
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
        Schema::dropIfExists('boxcars');
    }
};
