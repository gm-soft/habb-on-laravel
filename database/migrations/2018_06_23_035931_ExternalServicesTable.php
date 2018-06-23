<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExternalServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('external_services', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title')->comment("Название сервиса");
            $table->string('api_key')->comment("Уникальный ключ, который авторизует сервис");

            $table->string('comment')->nullable()->comment("Комментарий модератора");

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('gamers', function (Blueprint $table) {

            $table->integer('external_service_id')->nullable()->comment("Внешний сервис, который создал этот аккаунт");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gamers', function (Blueprint $table) {
            $table->dropColumn(['external_service_id']);
        });

        Schema::dropIfExists('external_services');
    }
}
