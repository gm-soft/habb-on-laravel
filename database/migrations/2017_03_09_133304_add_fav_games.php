<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFavGames extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gamers', function (Blueprint $table) {
            $table->addColumn('string', 'primary_game');
            $table->addColumn('text', 'secondary_games');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gamers', function (Blueprint $table) {
            $table->dropColumn(['primary_game', 'secondary_games']);
        });
    }
}
