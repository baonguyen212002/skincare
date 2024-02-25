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
        Schema::create('product_item', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_list')->nullable();
            $table->unsignedBigInteger('id_cat')->nullable();
            $table->string('name',255);
            $table->boolean('highlight')->default(0);
            $table->boolean('visible')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_item');
    }
};
