<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GamerNullableFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gamers', function (Blueprint $table) {

            $table
                ->dateTime('birthday')
                ->nullable()
                ->comment("День рождения человека")
                -> change();

            $table
                ->string('city')
                ->nullable()
                ->comment("Город, указанный при регистрации")
                -> change();

            $table
                ->string('status')
                ->nullable()
                ->comment("Ученик/Студент/Работает/Тунеядец")
                -> change();

            $table
                ->string('institution')
                ->nullable()
                ->comment("Место, где занят человек")
                -> change();
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
            $table
                ->dateTime('birthday')
                ->nullable(false)
                ->comment("День рождения человека")
                -> change();

            $table
                ->string('city')
                ->nullable(false)
                ->comment("Город, указанный при регистрации")
                -> change();

            $table
                ->string('status')
                ->nullable(false)
                ->comment("Ученик/Студент/Работает/Тунеядец")
                -> change();

            $table
                ->string('institution')
                ->nullable(false)
                ->comment("Место, где занят человек")
                -> change();
        });
    }
}
