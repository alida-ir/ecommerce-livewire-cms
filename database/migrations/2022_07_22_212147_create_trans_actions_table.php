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
        Schema::create('trans_actions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('order_id')->constrained();
            $table->unsignedBigInteger('price');
            $table->string('token')->nullable();
            $table->string('trans_id')->nullable();
            $table->string('card_number')->nullable();
            $table->string('trace_number')->nullable();
            $table->string('message')->nullable();
            $table->boolean('status')->default(false);
            $table->string('tracking_code')->unique()->nullable();
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
        Schema::dropIfExists('trans_actions');
    }
};
