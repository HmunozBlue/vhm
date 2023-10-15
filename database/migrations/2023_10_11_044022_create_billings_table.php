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
        Schema::create('billings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('currencyCode',20)->nullable();
            $table->dateTime('dateTimeEmission');
            $table->string('type', 20)->nullable();
            $table->string('addressSender')->nullable();
            $table->string('munSender',50)->nullable();
            $table->string('depSender',50)->nullable();
            $table->string('country',50)->nullable();
            $table->string('nitSender',15)->nullable();
            $table->string('comerceName',60)->nullable();
            $table->string('senderName',60)->nullable();
            $table->string('idReceptor',60)->nullable();
            $table->string('nameReceptor',60)->nullable();
            $table->smallInteger('amount')->nullable();
            $table->text('description')->nullable();
            $table->decimal('unitPrice', 8,2)->nullable();
            $table->decimal('price', 8,6)->nullable();
            $table->string('typeTax', 20)->nullable();
            $table->decimal('amountTaxable', 8,2)->nullable();
            $table->decimal('amountTax', 8,2)->nullable();
            $table->decimal('total', 8,2)->nullable();
            $table->string('bienOservice', 10)->nullable();
            $table->string('nitCertifier', 15)->nullable();
            $table->string('nameCertifier', 100)->nullable();
            $table->string('numAutorization', 100)->nullable();
            $table->string('serie', 100)->nullable();
            $table->integer('number')->unsigned();
            $table->dateTime('dateTimeCertification');
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
        Schema::dropIfExists('billings');
    }
};
