<?php

use App\Models\Team;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TeamRefactoring extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // удаляем эту таблицу безвозвратно
        Schema::dropIfExists('team_create_requests');

        // Сначала удаляем таблицу и переписываем ее с нуля
        Schema::dropIfExists('teams');

        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name', 100)->comment("Название команды");
            $table->string('city')->comment("Город, указанный при регистрации");
            $table->text('comment')->nullable()->comment("Комментарий модератора к данной тиме");

            $table->integer('captain_gamer_id')->unsigned()->nullable(false)->comment("Капитан команды");
            $table->foreign('captain_gamer_id', 'gamers_captain_gamer_id_foreign')->references('id')->on('gamers');

            // разрешаем на уровне схемы базы отсутствие остальных игроков, но будем уже в коде играть разрешениями
            $table->integer('second_gamer_id')->unsigned()->nullable()->comment("Второй игрок");
            $table->foreign('second_gamer_id', 'gamers_second_gamer_id_foreign')->references('id')->on('gamers');

            $table->integer('third_gamer_id')->unsigned()->nullable()->comment("Третий игрок");
            $table->foreign('third_gamer_id', 'gamers_third_gamer_id_foreign')->references('id')->on('gamers');

            $table->integer('forth_gamer_id')->unsigned()->nullable()->comment("Четвертый игрок");
            $table->foreign('forth_gamer_id', 'gamers_forth_gamer_id_foreign')->references('id')->on('gamers');

            $table->integer('fifth_gamer_id')->unsigned()->nullable()->comment("Пятый игрок");
            $table->foreign('fifth_gamer_id', 'gamers_fifth_gamer_id_foreign')->references('id')->on('gamers');

            // Запасной игрок
            $table->integer('optional_gamer_id')->unsigned()->nullable()->comment("Запасной игрок");
            $table->foreign('optional_gamer_id', 'gamers_optional_gamer_id_foreign')->references('id')->on('gamers');

            $table->softDeletes();
            $table->timestamps();
        });

        // таблица Many-To-Many между Team и Tournament

        Schema::create(Team::TeamTournamentParticipants_ManyToManyTableName, function (Blueprint $table) {
            $table->increments('id');

            $table->integer('team_id')->unsigned();
            $table->foreign('team_id')->references('id')->on('teams');

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
        Schema::dropIfExists(Team::TeamTournamentParticipants_ManyToManyTableName);

        Schema::dropIfExists('teams');

        // Скопипастчено с миграции CreateTeamsTable
        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->comment("Название команды. Максимум 100 символов");
            $table->string('city')->comment("Город, указанный при регистрации");
            $table->text('gamer_ids')->comment("Перечисленный массив геймеров-участников");
            $table->text('comment')->nullable()->comment("Комментарий пользователя к данной тиме");

            // строка ниже скопипастчена с миграции AddRolesToTeams
            $table->text('gamer_roles')->nullable()->after('gamer_ids')->comment('Массив ролей игроков. Позиция роли соответсвует позиции игрока');
            $table->timestamps();
        });

        // Скопипастчено с миграции CreateTeamCreateRequestsTable
        Schema::create('team_create_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->comment("Название команды. Максимум 100 символов");
            $table->string('city')->comment("Город");

            $table->string('requester_name')->comment("Имя заявляющего");
            $table->string('requester_phone')->comment("Телефон заявляющего");
            $table->string('requester_email') ->comment("Email заявляющего");
            $table->string('requester_comment', 200)->nullable()->comment("Комментарий заявляющего к своей заявке");

            $table->text('participant_ids')->comment("Перечисленный массив геймеров-участников");
            $table->text('participant_names')->comment("Перечисленный массив имен геймеров");
            $table->text('participant_roles')->comment("Перечисленный массив ролей геймеров");

            $table->boolean('request_processed')->default(false)->comment('Обработана ли заявка');
            $table->boolean('team_created')->default(false)->comment('Создана ли команда');

            $table->string('team_id')->nullable()->comment("Созданная команда. Если null, то не создана");


            $table->text('comment')->nullable() ->comment("Комментарий пользователя к заявке");

            $table->softDeletes();
            $table->timestamps();
        });
    }
}
