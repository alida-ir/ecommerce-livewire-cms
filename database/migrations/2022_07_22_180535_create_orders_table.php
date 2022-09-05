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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->unsignedBigInteger('transportation_cost');
            $table->tinyInteger('transportation_cost_status')->default(0);
            $table->unsignedBigInteger('total_price');
            $table->unsignedBigInteger('payment_price');
            $table->unsignedBigInteger('payment_status');
            $table->unsignedBigInteger('zip_code');
            $table->longText('address');
            $table->longText('state');
            $table->string('token')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
