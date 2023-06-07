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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('size');
            $table->decimal('price');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('picture_id');
            $table->foreign('type_id')->references('id')->on('room_types');
            $table->foreign('picture_id')->references('id')->on('pictures');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
