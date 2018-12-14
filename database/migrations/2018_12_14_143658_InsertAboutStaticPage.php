<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertAboutStaticPage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $now = \Carbon\Carbon::now();

        DB::table('static_pages')->insert([
                [
                    'unique_name' => \App\Models\StaticPage::AboutUsPage_RowName,
                    'title' => 'О нас',
                    'content' => '&lt;p&gt;
                Киберспортивная организация HABB была создана 1 ноября 2016 года под эгидой компании NEXT (Центры Развлечений).
            &lt;/p&gt;
            &lt;p&gt;
                С момента создания организации мы провели много разных мероприятий:
                &lt;br&gt;
                киберспортивые чемпионаты по Алматы и Казахстану, презентации новинок компаний партнеров,
                развлекательные мероприятия для аудитории, фан встреча команды Gambit и прочие.
            &lt;/p&gt;
            &lt;div class=&quot;mt-2&quot;&gt;
                &lt;div class=&quot;card&quot;&gt;
                    &lt;div class=&quot;card-body&quot;&gt;
                        &lt;div class=&quot;card-text&quot;&gt;

                            &lt;div class=&quot;w-100 text-center&quot;&gt;
                                &lt;span class=&quot;h3&quot;&gt;Наши партнеры:&lt;/span&gt;
                            &lt;/div&gt;

                            &lt;div class=&quot;row text-center mt-2&quot;&gt;

                                &lt;div class=&quot;col-md-4&quot;&gt;
                                    &lt;ul class=&quot;list-unstyled&quot;&gt;
                                        &lt;li&gt;HTC&lt;/li&gt;
                                        &lt;li&gt;HP&lt;/li&gt;
                                        &lt;li&gt;ASUS&lt;/li&gt;
                                        &lt;li&gt;HyperX&lt;/li&gt;
                                        &lt;li&gt;Gorilla Energy&lt;/li&gt;
                                        &lt;li&gt;Gigabyte&lt;/li&gt;
                                        &lt;li&gt;Университет Туран&lt;/li&gt;
                                        &lt;li&gt;Aorus&lt;/li&gt;
                                        &lt;li&gt;Steelseries&lt;/li&gt;
                                    &lt;/ul&gt;
                                &lt;/div&gt;

                                &lt;div class=&quot;col-md-4&quot;&gt;
                                    &lt;ul class=&quot;list-unstyled&quot;&gt;
                                        &lt;li&gt;Razer&lt;/li&gt;
                                        &lt;li&gt;Intel&lt;/li&gt;
                                        &lt;li&gt;Deepcool&lt;/li&gt;
                                        &lt;li&gt;Aerocool&lt;/li&gt;
                                        &lt;li&gt;Fanta&lt;/li&gt;
                                        &lt;li&gt;Raiymbek Bottlers&lt;/li&gt;
                                        &lt;li&gt;Laimon Fresh&lt;/li&gt;
                                        &lt;li&gt;Spasibeacoup&lt;/li&gt;
                                        &lt;li&gt;NVIDIA&lt;/li&gt;
                                    &lt;/ul&gt;
                                &lt;/div&gt;

                                &lt;div class=&quot;col-md-4&quot;&gt;
                                    &lt;ul class=&quot;list-unstyled&quot;&gt;
                                        &lt;li&gt;Технодом&lt;/li&gt;
                                        &lt;li&gt;GameOverShop&lt;/li&gt;
                                        &lt;li&gt;SecretShop&lt;/li&gt;
                                        &lt;li&gt;GameVice&lt;/li&gt;
                                        &lt;li&gt;Timecafe&lt;/li&gt;
                                        &lt;li&gt;Сбербанк&lt;/li&gt;
                                        &lt;li&gt;Меломан&lt;/li&gt;
                                        &lt;li&gt;Altel&lt;/li&gt;
                                    &lt;/ul&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                            &lt;div class=&quot;w-100 text-center&quot;&gt;и многие другие.&lt;/div&gt;

                        &lt;/div&gt;
                    &lt;/div&gt;
                &lt;/div&gt;
            &lt;/div&gt;
            &lt;p class=&quot;mt-2&quot;&gt;
                Наша цель - приобщить всех неравнодушных людей к молодой, но весьма насыщенной вселенной &mdash; киберспорту!
                Игроки, зрители и все, кто видит в данном направлении возможность профессионального роста и готов шагать в ногу с современным ритмом кибер-сферы.
                Индустрия киберспорта стремительно разрастается с каждым часом &mdash; событий всё больше, новости всё интереснее!
            &lt;/p&gt;',
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
        DB::table('static_pages')
            ->where('unique_name', '=', \App\Models\StaticPage::AboutUsPage_RowName)
            ->delete();
    }
}
