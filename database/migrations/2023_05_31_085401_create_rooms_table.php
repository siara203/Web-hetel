<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room');
            $table->unsignedBigInteger('category_id');
            $table->tinyInteger('status')->default(0)->comment('0 = Available, 1 = Unavailable');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('room_categories');
        });
    }

    public function down()
    {
        Schema::dropIfExists('rooms');
    }
};
