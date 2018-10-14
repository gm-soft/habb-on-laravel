<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StaticPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('static_pages', function (Blueprint $table) {
            $table->increments('id');

            $table->string('unique_name', 100)->unique()->comment('Имя, которе используется для уникальной идентификации внутри системы');
            $table->string('title', 100)->nullable(false)->comment('Видимый заголовок');
            $table->text('content');

            $table->timestamps();
        });

        $now = \Carbon\Carbon::now();

        DB::table('static_pages')->insert([
                [
                    'unique_name' => \App\Models\StaticPage::EventSchedule_RowName,
                    'title' => 'Расписание ивентов',
                    'content' => '',
                    'created_at' => $now,
                    'updated_at' => $now
                ],
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('static_pages');
    }
}
