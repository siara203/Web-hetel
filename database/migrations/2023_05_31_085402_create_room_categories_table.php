<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('room_categories', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->float('price');
            $table->text('cover_img');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('room_categories');
    }
};
