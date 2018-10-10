<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TournamentBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournament_banner', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('banner_id')->unsigned();
            $table->foreign('banner_id')->references('id')->on('banners');

            $table->integer('tournament_id')->unsigned();
            $table->foreign('tournament_id')->references('id')->on('tournaments');

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
        Schema::table('tournament_banner', function (Blueprint $table){

            $table->dropForeign(['banner_id']);
            $table->dropForeign(['tournament_id']);
        });

        Schema::dropIfExists('tournament_banner');
    }
}
