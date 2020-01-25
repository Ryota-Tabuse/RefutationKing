<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name');
            $table->bigInteger('thema_id');
            $table->bigInteger('option_a_user_id');
            $table->bigInteger('option_b_user_id');
            $table->timestamps();

            //外部制約
            $table->foreign('thema_id')->references('id')->on('themes');
            $table->foreign('option_a_user_id')->references('id')->on('users');
            $table->foreign('option_b_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
