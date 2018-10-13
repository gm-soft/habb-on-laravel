<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HashtagsFieldAdd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tournaments', function (Blueprint $table) {

            $table->string('hashtags', \App\Helpers\Constants::HashTagFieldMaxLength)->nullable()->after('event_date')->comment('Хэштеги через запятую ');
        });

        Schema::table('posts', function (Blueprint $table) {

            $table->string('hashtags', \App\Helpers\Constants::HashTagFieldMaxLength)->nullable()->after('announce_image')->comment('Хэштеги через запятую ');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tournaments', function (Blueprint $table) {
            $table->dropColumn('hashtags');
        });
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('hashtags');
        });
    }
}
