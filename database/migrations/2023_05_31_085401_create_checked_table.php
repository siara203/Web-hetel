<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checked', function (Blueprint $table) {
            $table->id();
            $table->string('ref_no');
            $table->unsignedBigInteger('room_id');
            $table->text('name');
            $table->string('contact_no');
            $table->datetime('date_in');
            $table->datetime('date_out');
            $table->unsignedBigInteger('booked_cid');
            $table->tinyInteger('status')->default(0)->comment('0 = pending, 1=checked in, 2 = checked out');
            $table->datetime('date_updated')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            
            // Add foreign key constraints
            $table->foreign('room_id')->references('id')->on('rooms');
            $table->foreign('booked_cid')->references('id')->on('room_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checked');
    }
};
