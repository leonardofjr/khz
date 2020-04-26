<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipmentAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('address_id')->nullable();
            $table->foreign('address_id')->references('id')->on('shipment_addresses');
            $table->string('address_1');
            $table->string('address_2');
            $table->string('city');
            $table->string('country');
            $table->string('postal_code');
            $table->string('province');
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
        Schema::dropIfExists('shipment_addresses');
    }
}
