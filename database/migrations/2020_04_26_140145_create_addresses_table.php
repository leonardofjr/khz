<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->string('address_1');
            $table->string('address_2');
            $table->string('city');
            $table->string('country');
            $table->string('postal_code');
            $table->string('province');
            $table->string('billing_address_id');
            $table->foreign('billing_address_id')->references('id')->on('billing_addresses');
            $table->string('shipment_addresses');
            $table->foreign('shipment_addresses')->references('id')->on('shipping_addresses');
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
        Schema::dropIfExists('addresses');
    }
}
