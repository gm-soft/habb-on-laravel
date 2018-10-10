<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TournamentRefactor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tournaments', function (Blueprint $table) {

            $table->dropColumn('tournament_type');
            $table->dropColumn('participant_max_count');

            $table->dropColumn('participant_ids');
            $table->dropColumn('participant_scores');

            $table->dropColumn(['game']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tournaments', function (Blueprint $table) {

            // взяты из прежней миграции, создающей эти столбцы
            $table->string('tournament_type', 20)->comment('Тип турнира. team или gamer');
            $table->integer('participant_max_count')->default(16)->comment('Максимальное кол-во участников');

            $table->text('participant_ids')->nullable()->comment('Массив айдишников участников');
            $table->text('participant_scores')->nullable()->comment('Массив очков');

            $table->string('game')
                ->nullable()
                ->after('tournament_type')
                ->comment('Игровая дисциплина');
        });
    }
}
