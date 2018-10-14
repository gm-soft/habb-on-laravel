<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title', 100)->nullable()->comment('Заголовок баннера');
            $table->string('subtitle', 200)->nullable()->comment('Подзаголовок');

            $table->string('image_path')->comment('Путь до картинки');
            $table->boolean('attached_to_main_page')->comment('true/false, прикреплена ли к главной странице')->default(false);

            $table->softDeletes();
            $table->timestamps();
        });

        $now = \Carbon\Carbon::now();

        DB::table('banners')->insert( [
                    [
                        'title' => 'HABB',
                        'subtitle' => 'Сообщество геймеров Казахстана',
                        'image_path' => 'storage/dote2.jpg',
                        'attached_to_main_page' => true,
                        'created_at' => $now,
                        'updated_at' => $now
                    ],
                    [
                        'title' => 'Новости',
                        'subtitle' => 'Мы рассказываем о самых интересных киберспортивных мероприятиях Казахстана',
                        'image_path' => 'storage/cybersport.jpg',
                        'attached_to_main_page' => true,
                        'created_at' => $now,
                        'updated_at' => $now
                    ],
                    [
                        'title' => 'Регистрация HABB ID',
                        'subtitle' => 'У нас вы можете получить HABB ID и участвовать с ним в турнирах',
                        'image_path' => 'storage/tihall.jpg',
                        'attached_to_main_page' => true,
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
        Schema::dropIfExists('banners');
    }
}
