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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('tracking_no');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->mediumText('address');
            $table->string('country');
            $table->string('city');
            $table->string('state');
            $table->string('zip');
            $table->tinyInteger('status')->default('0')->comment('0=Pending,1=Complete,2=Shipping,3=Cancelled,4=Complated,5=Proccessing,6=Refunded');
            $table->string('status_message')->nullable();
            $table->string('payment_mode');
            $table->string('payment_id')->nullable();
            $table->tinyInteger('shipping_different')->default('0')->comment('0=No,1=Yes');
            $table->string('different_name')->nullable();
            $table->string('different_email')->nullable();
            $table->string('different_phone')->nullable();
            $table->mediumText('different_address')->nullable();
            $table->string('different_country')->nullable();
            $table->string('different_city')->nullable();
            $table->string('different_state')->nullable();
            $table->string('different_zip')->nullable();
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
        Schema::dropIfExists('order');
    }
};
