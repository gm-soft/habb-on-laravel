<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TournamentEventDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tournaments', function (Blueprint $table) {

            $table->dropColumn('reg_closed_at');

            $table->renameColumn('started_at', 'event_date');
            $table->boolean('attached_to_nav')->default(false);
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

            $table->renameColumn('event_date', 'started_at');
            $table->dateTime('reg_closed_at')->nullable()->comment('Время закрытия регистрации');
            $table->dropColumn('attached_to_nav');
        });
    }
}
