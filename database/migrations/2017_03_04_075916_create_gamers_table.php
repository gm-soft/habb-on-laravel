<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gamers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment("Имя");
            $table->string('last_name')->comment("Фамилия");
            $table->string('phone')->unique()->comment("Номер телефона");
            $table->string('email')->unique()->comment("Email");
            $table->dateTime('birthday')->comment("День рождения человека");
            $table->string('city')->comment("Город, указанный при регистрации");
            $table->string('vk_page')->comment("Ссылка на профиль Вконтакте");

            $table->string('status')->comment("Ученик/Студент/Работает/Тунеядец");
            $table->string('institution')->comment("Место, где занят человек");

            $table->text('comment')->comment("Комментарий пользователя к данному аккаунту");

            $table->string('lead_id')->nullable()->comment("Связанный лид в CRM");
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
        Schema::dropIfExists('gamers');
    }
}
