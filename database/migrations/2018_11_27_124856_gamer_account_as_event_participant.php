<?php

use App\Models\GamerTournamentEventGuest;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GamerAccountAsEventParticipant extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(GamerTournamentEventGuest::Gamers_EventGuests_ManyToManyTableName, function (Blueprint $table) {
            $table->increments('id');

            $table->integer('gamer_id')->unsigned();
            $table->foreign('gamer_id')->references('id')->on('gamers');

            $table->integer('tournament_id')->unsigned();
            $table->foreign('tournament_id')->references('id')->on('tournaments');

            $table->timestamps();
        });

        Schema::table('gamers', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('secondary_games')->comment('Если true, значит аккаунт активирован');
            $table->string('vk_page')->nullable()->change();
        });

        Schema::table('tournaments', function (Blueprint $table) {
            $table->dateTime('registration_deadline')->nullable()->after('event_date')->comment('Дэдлайн регистрации команд на участие');
        });

        \App\Models\Tournament::withTrashed()
            ->whereNull('registration_deadline')
            ->update([
                "registration_deadline" => DB::raw("`event_date`"),
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(GamerTournamentEventGuest::Gamers_EventGuests_ManyToManyTableName, function (Blueprint $table){

            $table->dropForeign(['gamer_id']);
            $table->dropForeign(['tournament_id']);
        });

        Schema::dropIfExists(GamerTournamentEventGuest::Gamers_EventGuests_ManyToManyTableName);

        Schema::table('gamers', function (Blueprint $table) {
            $table->dropColumn('is_active');
            $table->string('vk_page')->nullable()->change();
        });

        Schema::table('tournaments', function (Blueprint $table) {
            $table->dropColumn('registration_deadline');
        });
    }
}
