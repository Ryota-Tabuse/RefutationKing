<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('content');
            $table->bigInteger('room_id');
            $table->bigInteger('sending_user_id')->nullable();;
            $table->bigInteger('recieving_user_id')->nullable();;
            $table->timestamps();

            //外部制約
            $table->foreign('room_id')->references('id')->on('rooms');
            $table->foreign('sending_user_id')->references('id')->on('users');
            $table->foreign('recieving_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
