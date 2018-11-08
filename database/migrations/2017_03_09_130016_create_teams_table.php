<?php


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->comment("Название команды. Максимум 100 символов");
            $table->string('city')->comment("Город, указанный при регистрации");
            $table->text('gamer_ids')->comment("Перечисленный массив геймеров-участников");
            $table->text('comment')->nullable()->comment("Комментарий пользователя к данной тиме");
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
        Schema::dropIfExists('teams');
    }
}
