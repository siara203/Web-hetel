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
                $table->integer('price');
                $table->unsignedBigInteger('type_id');
                $table->string('image1')->nullable();
                $table->string('image2')->nullable();
                $table->string('image3')->nullable();
                $table->string('image4')->nullable();
                $table->string('image5')->nullable();
                $table->foreign('type_id')->references('id')->on('room_types');
                $table->string('status');
                $table->text('description')->nullable();
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
