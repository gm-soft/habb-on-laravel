<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTournamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournaments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)
                ->comment('Название турнира');
            $table->text('comment')->nullable()
                ->comment('Комментарий пользователя');
            $table->text('public_description')
                ->comment('Публичное описание, доступное открыто');

            $table->string('tournament_type', 20)
                ->comment('Тип турнира. team или gamer');

            $table->integer('participant_max_count')->default(16)
                ->comment('Максимальное кол-во участников');

            $table->text('participant_ids')->nullable()
                ->comment('Массив айдишников участников');
            $table->text('participant_scores')->nullable()
                ->comment('Массив очков');

            $table->dateTime('started_at')->nullable()
                ->comment('Начало турнира');
            $table->dateTime('reg_closed_at')->nullable()
                ->comment('Время закрытия регистрации');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tournaments');
    }
}
