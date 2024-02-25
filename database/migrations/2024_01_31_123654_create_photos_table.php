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
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('stt')->default(1);
            $table->string('image');
            $table->string('title',255)->nullable();
            $table->string('description',255)->nullable();
            $table->string('link',255)->nullable();
            $table->string('type');
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
        Schema::dropIfExists('photos');
    }
};
