<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordsGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('record_game', function(Blueprint $table){
            $table->increments('id')->unsigned();

            $table->integer('record_id')->unsigned()->index();
            $table->foreign('record_id')
                ->references('id')
                ->on('records')
                ->onDelete('cascade');

            $table->integer('game_id')->unsigned()->index();
            $table->foreign('game_id')
                ->references('id')
                ->on('games')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('record_game');
    }
}
