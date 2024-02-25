<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_list')->nullable();
            $table->unsignedBigInteger('id_cat')->nullable();
            $table->unsignedBigInteger('id_item')->nullable();
            $table->unsignedBigInteger('id_brand')->nullable();
            $table->string('name',255);
            $table->string('tenkhongdauvi',255);
            $table->integer('views')->default(0);
            $table->string('image')->nullable();
            $table->string('content',255)->nullable();
            $table->boolean('highlight')->default(0);
            $table->string('description',255)->nullable();
            $table->double('price')->nullable()->default(0);
            $table->boolean('visible')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
