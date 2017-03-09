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
            $table->string('primary_game')->nullable()->after('lead_id');
            $table->text('secondary_games')->nullable()->after('lead_id');
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
