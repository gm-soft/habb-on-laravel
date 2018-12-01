<?php

use App\Models\GamerTournamentEventGuest;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GamersEventsGuestsSharecount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(GamerTournamentEventGuest::Gamers_EventGuests_ManyToManyTableName, function (Blueprint $table) {
            $table->integer('link_shares_count')->default(0)->comment('Кол-во шарингов ссылкой');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(GamerTournamentEventGuest::Gamers_EventGuests_ManyToManyTableName, function (Blueprint $table) {
            $table->dropColumn('link_shares_count');
        });
    }
}
