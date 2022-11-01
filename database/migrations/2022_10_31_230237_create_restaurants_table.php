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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('address');
            $table->string('picture')->nullable();
            $table->string('latitude');
            $table->string('longitude');
            $table->string('phone');
            $table->string('bank_account');
            $table->unsignedBigInteger('salesman_id')->unique();
            $table->bigInteger('shipment_price')->nullable();
            $table->foreign('salesman_id')->references('id')->on('salesmen');
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
        Schema::dropIfExists('restaurants');
    }
};
