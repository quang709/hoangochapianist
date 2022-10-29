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
        Schema::create('coupon_customer', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('coupon_id');
            $table->unsignedBigInteger('customer_id');
            $table->foreign('coupon_id')->references('id')->on('coupons')
                ->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')
                ->onDelete('cascade');
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
        Schema::dropIfExists('coupon_customer');
    }
};
