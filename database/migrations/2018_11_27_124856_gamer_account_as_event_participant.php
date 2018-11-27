<?php

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
        Schema::create(\App\Models\Tournament::Gamers_EventGuests_ManyToManyTableName, function (Blueprint $table) {
            $table->increments('id');

            $table->integer('gamer_id')->unsigned();
            $table->foreign('gamer_id')->references('id')->on('gamers');

            $table->integer('tournament_id')->unsigned();
            $table->foreign('tournament_id')->references('id')->on('tournaments');

            $table->timestamps();
        });

        Schema::table('gamers', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('secondary_games')->comment('Если true, значит аккаунт активирован');
        });

        Schema::table('tournaments', function (Blueprint $table) {
            $table->dateTime('registration_deadline')->after('event_date')->comment('Дэдлайн регистрации команд на участие');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(\App\Models\Tournament::Gamers_EventGuests_ManyToManyTableName, function (Blueprint $table){

            $table->dropForeign(['gamer_id']);
            $table->dropForeign(['tournament_id']);
        });

        Schema::dropIfExists(\App\Models\Tournament::Gamers_EventGuests_ManyToManyTableName);

        Schema::table('gamers', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });

        Schema::table('tournaments', function (Blueprint $table) {
            $table->dropColumn('registration_deadline');
        });
    }
}
