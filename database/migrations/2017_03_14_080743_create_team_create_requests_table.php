<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamCreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_create_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)                 ->comment("Название команды. Максимум 100 символов");
            $table->string('city')                      ->comment("Город");

            $table->string('requester_name')            ->comment("Имя заявляющего");
            $table->string('requester_phone')           ->comment("Телефон заявляющего");
            $table->string('requester_email')           ->comment("Email заявляющего");
            $table->string('requester_comment', 200)->nullable()->comment("Комментарий заявляющего к своей заявке");

            $table->text('participant_ids')     ->comment("Перечисленный массив геймеров-участников");
            $table->text('participant_names')   ->comment("Перечисленный массив имен геймеров");
            $table->text('participant_roles')   ->comment("Перечисленный массив ролей геймеров");

            $table->boolean('request_processed')->default(false)->comment('Обработана ли заявка');
            $table->boolean('team_created')     ->default(false)->comment('СОздана ли команда');

            $table->string('team_id')->nullable()->comment("Созданная команда. Если null, то не создана");


            $table->text('comment')->nullable() ->comment("Комментарий пользователя к заявке");

            $table->softDeletes();
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
        Schema::dropIfExists('team_create_requests');
    }
}
