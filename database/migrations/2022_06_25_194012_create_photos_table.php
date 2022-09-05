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
        Schema::create('photos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('title')->default("This is Photo")->nullable();
            $table->string('description')->default("This is Photo")->nullable();
            $table->unsignedInteger('category_id')->index()->nullable();
            $table->unsignedInteger('parent_id')->index()->nullable();
            $table->foreignId('product_id')->nullable()->constrained();
            $table->foreignId('brand_id')->nullable()->constrained();
            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('parent_id')->references('id')->on('photos')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('path')->unique();
            $table->string('size');
            $table->string('mime');
            $table->string('width');
            $table->string('height');
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
        Schema::dropIfExists('photos');
    }
};
