<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100)->comment('Название статьи');
            $table->text('content')->comment('Тело статьи. Форматировано в markdown');
            $table->bigInteger('views')->comment('Кол-во просмотров, инкрементриующееся при открытии');
            $table->timestamps();
            $table->softDeletes(); // Посты не удаляются
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
