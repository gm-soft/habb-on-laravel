<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">

    <title>Система учета Habb. Презентация</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!--link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}"-->
    <link rel="stylesheet" href="{{ asset('thirdparty/fa/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('thirdparty/reveal/css/reveal.css') }}">
    <link rel="stylesheet" href="{{ asset('thirdparty/reveal/css/theme/black.css') }}" id="theme">

    <!-- Theme used for syntax highlighting of code -->
    <link rel="stylesheet" href="{{ asset('thirdparty/reveal/css/zenburn.css') }}">

    <!--[if lt IE 9]>
    <script src="{{ asset('thirdparty/reveal/js/html5shiv.js') }}"></script>
    <![endif]-->
</head>

<body>

<div class="reveal">

    <!-- Any section element inside of this container is displayed as a slide -->
    <div class="slides">
        <section>
            <h1>Habb</h1>
            <h3>Система учета и автоматизации</h3>
            <p>
                <small>Автор проекта <u>Горбатюк Максим</u></small>
            </p>
        </section>

        <!-- Назначение приложения -->
        <section>
            <section>
                <h2>Назначение приложения</h2>
                <p class="mt-3">
                    Система предназначена для сбора, хранения и учета информации, обрабатываемой командой "Habb"
                </p>
            </section>
            <section>
                <h4>О команде Habb</h4>
                <p class="mt-3">
                    Команда "Habb" занимается развитием популярности киберспорта в городе Алматы,
                    а также привлекая команды и из других городов Казахстана.
                </p>

            </section>
            <section>
                <h4>Достижения команды Habb</h4>
                <ul class="mt-3">
                    <li>Турниры NPL</li>
                    <li>Памбстомпы по Dota2 и CS:GO</li>
                    <li>Турниры "Битва за Туран"</li>
                </ul>
                <aside class="notes">
                    В числе результатов деятельности команды не только система постоянных небольших
                    турниров NPL и памбстомпов, но и крупные мероприятия, как "Битва за Туран".
                </aside>
            </section>
        </section>

        <!-- Цель проекта -->
        <section>

            <section>
                <h2>Выявленные проблемы</h2>
                <div class="mt-3">
                    Рутинные процессы, которые могли бы быть автоматизированы
                </div>
                <ul>
                    <li>Возврат HABB ID после ручной обработки</li>
                    <li>Перенос информации в CRM систему из таблицы</li>
                    <li>Ручное присвоение очков участникам команды</li>
                    <li>Составление рейтинга в ручном режиме</li>
                </ul>
            </section>

            <section>
                <h2>Требования к разрабатываемой ИС</h2>
                <div class="mt-3">
                    Разработка ПО для команды на базе веб-приложения, решающее выявленные проблемы и реализующее функции:
                </div>
                <ul>
                    <li>Сбор информации и выдача HABB ID</li>
                    <li>Хранение и синхронизация с CRM</li>
                    <li>Обработка и учет информации. Присвоение очков</li>
                    <li>Рейтинг формируется автоматически</li>
                    <li>Новости для игроков и команд</li>
                    <li>Разделение прав доступа</li>
                </ul>
            </section>

        </section>
        <!-- Два пути разработки -->
        <section>
            <section>
                <h2>Выбор методологии разработки</h2>
                <ul>
                    <li>Гибкая модель</li>
                    <li>Каскадная модель</li>
                </ul>
                <div>
                    <img src="{{ asset('images/reveal/waterfall.jpg') }}" width="400">
                    <img src="{{ asset('images/reveal/iterative.jpg') }}" width="400">
                </div>
            </section>

            <section>
                <h4><u>Каскадная</u> модель разработки</h4>
                <p>
                <img src="{{ asset('images/reveal/waterfall.jpg') }}" width="600">
            </section>

            <section>
                <h4><u>Гибкая</u> модель разработки</h4>
                <img src="{{ asset('images/reveal/iterative.jpg') }}" width="600">
            </section>

            <section>
                <table>
                    <thead>
                        <tr>
                            <th>Сравнение подходов</th>
                            <th>Каскадная</th>
                            <th>Гибкая</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Техзадание</td>
                            <td>Подробный документ</td>
                            <td>Видение. Список задач на каждый спринт</td>
                        </tr>

                        <tr>
                            <td>Сроки получения функционала</td>
                            <td>Прописаны в ТЗ</td>
                            <td>В конце спринта (2-4 нед.)</td>
                        </tr>

                        <tr>
                            <td>Оценка стоимости</td>
                            <td>Заранее известна цена</td>
                            <td>Цена неизвестна, т.к. зависит от развития проекта</td>
                        </tr>
                    </tbody>
                </table>
            </section>

            <section>
                <h2>Сравнение в картинке</h2>
                <img src="{{ asset('images/reveal/agile-vs-cascade.jpg') }}" width="600">
            </section>
        </section>

        <!-- Agile методология -->
        <section>
            <section>
                <h2>Agile методология</h2>
            </section>

            <section>
                <h4>Сущность методологии</h4>
                <ul>
                    <li>Спринты: циклы развития продукта</li>
                    <li>Роли: заказчик, скрам-мастер, исполнители</li>
                    <li>Планирование на спринт</li>
                </ul>
            </section>
            <section>
                <h4>Итерация разработки (спринт)</h4>
                <ul>
                    <li>Формирование списка задач (10-15)</li>
                    <li>Планирование и анализ задач</li>
                    <li>Реализация (2-4 недели)</li>
                    <li>Внедрение версии продукта</li>
                    <li>Ретроспектива - подведение итогов</li>
                </ul>
            </section>

            <section>
                <h4>Схема работы по SCRUM</h4>
                <img src="{{ asset('images/reveal/scrum.jpg') }}" width="700">
            </section>
        </section>

        <!-- Принцип работы над проектом -->
        <section>
            <h2>Принцип работы над проектом</h2>
            <ul>
                <li>Гибкий подход</li>
                <li>Длительность итераций (спринта): 2 недели</li>
                <li>Разработка MVP в течение 1 спринта</li>
                <li>Внедрение нового функционала каждый спринт</li>
                <li>Встречи перед каждым спринтом для обсуждения и анализа</li>
            </ul>
        </section>

        <!-- Проектирование и технологии -->
        <section>
            <section>
                <h2>Проектирование приложения</h2>
                <p>
                    Архитектура приложения, структурные компоненты, платформа веб-приложения.
                </p>
            </section>

            <section>
                <h2>Структура информационной системы</h2>
                <ul>
                    <li>Веб-портал (Laravel 5.4 - PHP7)</li>
                    <li>База данных (MySQL)</li>
                    <li>Веб-сервер (Apache)</li>
                    <li>Хостинг VPS (Virtual Private Server)</li>
                </ul>
            </section>

            <section>
                <h2>Логические модули</h2>
                <ul>
                    <li>
                        Операции CRUD с моделями:
                        <ul>
                            <li>Аккаунты игроков</li>
                            <li>Команды</li>
                            <li>Новости</li>
                            <li>Турниры</li>
                        </ul>
                    </li>
                    <li>Синхронизация с CRM "Битрикс24"</li>
                    <li>
                        Разделение портала:
                        <ul>
                            <li>Внешний интерфейс</li>
                            <li>Панель администратора</li>
                        </ul>
                    </li>

                </ul>
            </section>

            <section>
                <h2>Архитектура веб-портала</h2>
                <table>
                    <tbody>
                    <tr>
                        <th>Model</th>
                        <td>Абстракции в БД</td>
                        <td>Объекты реального мира в виде абстракций</td>
                    </tr>

                    <tr>
                        <th>View</th>
                        <td>Представление модели</td>
                        <td>Веб-страницы, на которых отображены модели БД</td>
                    </tr>

                    <tr>
                        <th>Controller</th>
                        <td>Взаимодействие моделей и представлений</td>
                        <td>Описывают взаимодействие и трансформации моделей и представлений</td>
                    </tr>
                    </tbody>
                </table>
            </section>
            <section>
                <h2>Архитектура веб-портала</h2>
                <p>
                    Конструирование внешнего интерфейса веб-портала
                </p>
                <ul>
                    <li>Bootstrap 4 (https://v4-alpha.getbootstrap.com/) - панель администратора</li>
                    <li>UIKit 3 (https://getuikit.com/) - внешний интерфейс</li>
                </ul>
            </section>
        </section>

        <section>
            <section>
                <h2>Программная реализация проекта</h2>
                <p>
                    Примеры программного кода
                </p>
            </section>

            <section>
                <h2>Модель "Аккаунт"</h2>
                <p>
                    Код, описывающий свойства и поведение модели
                </p>
                <pre>
                    <code class="hljs" data-trim contenteditable style="font-size: 16px;">
                    class Gamer extends Ardent
                        implements ISelectableOption, ITournamentParticipant
                    {
                        use FormAccessible, SoftDeletes;

                        public static $rules = [
                            'name'      => 'required',
                            'last_name' => 'required',
                            'email'     => 'required|between:3,100|email|unique:gamers',
                            'phone'     => 'required|unique:gamers',
                        ];

                        protected $table = "gamers";
                        protected $fillable = array(
                            'name','last_name','phone',
                            'email','birthday','city',
                            'vk_page','status','institution',
                            'comment','lead_id'
                        );

                        protected $dates = [
                            'birthday', 'deleted_at'
                        ];
                        protected $casts = [
                            'secondary_games' => 'array'
                        ];
                        public static $relationsData = [
                            'scores' => [self::HAS_MANY, 'GamerScore']
                        ];

                        /**
                         * Массив привязанных очков GamerScore
                         * @return \Illuminate\Database\Eloquent\Relations\HasMany
                         */
                        public function scores()
                        {
                            return $this->hasMany('App\Models\GamerScore');
                        }
                    }
                    </code>
                </pre>
            </section>

            <section>
                <h2>Модель "Очки аккаунта"</h2>
                <p>Набор очков аккаунта по дисциплинам</p>
                <pre>
                        <code class="hljs" data-trim contenteditable style="font-size: 16px;">
                            class GamerScore extends Ardent implements IScoreInstance
                            {
                                protected $table = 'gamer_scores';
                                protected $fillable = ['game_name'];

                                public static $relationsData = [
                                    'gamer' => [self::BELONGS_TO, 'Gamer']
                                ];

                                public function gamer()
                                {
                                    return $this->belongsTo('App\Models\Gamer');
                                }

                                /**
                                 * Возвращает массив стандартных очков
                                 * @param null $games
                                 * @return array
                                 */
                                public static function getScoreSet($games = null) {
                                    $games = !is_null($games) ? $games : Constants::getGameArray();
                                    $result = [];
                                    foreach ($games as $game) {
                                        $result[] = new self(['game_name' => $game]);
                                    }
                                    return $result;
                                }
                            }
                        </code>
                    </pre>
            </section>

            <section>
                <h2>Миграции БД</h2>
                <pre>
                    <code class="hljs" data-trim contenteditable style="font-size: 16px;">
                        class CreateGamersTable extends Migration
                        {
                            public function up()
                            {
                                Schema::create('gamers', function (Blueprint $table) {
                                    $table->increments('id');
                                    $table->string('name')
                                        ->comment("Имя");
                                    $table->string('last_name')
                                        ->comment("Фамилия");
                                    $table->string('phone')
                                        ->unique()->comment("Номер телефона");
                                    $table->string('email')
                                        ->unique()->comment("Email");
                                    $table->dateTime('birthday')
                                        ->comment("День рождения человека");
                                    $table->string('city')
                                        ->comment("Город, указанный при регистрации");
                                    $table->string('vk_page')
                                        ->comment("Ссылка на профиль Вконтакте");

                                    $table->string('status')
                                        ->comment("Ученик/Студент/Работает/Тунеядец");
                                    $table->string('institution')
                                        ->comment("Место, где занят человек");

                                    $table->text('comment')->nullable()
                                        ->comment("Комментарий пользователя к данному аккаунту");

                                    $table->string('lead_id')
                                        ->nullable()->comment("Связанный лид в CRM");
                                    $table->timestamps();
                                });
                            }

                            public function down()
                            {
                                Schema::dropIfExists('gamers');
                            }
                        }
                    </code>
                </pre>
            </section>

            <section>
                <h2>Маршрутизация</h2>
                <pre>
                    <code class="hljs" data-trim contenteditable>
                        Route::get('/home', 'HomeController@index');
                        Route::get('/news', 'FrontController@news');
                        Route::get('/news/{id}', 'FrontController@openPost');

                        Route::group(['prefix' => 'admin', 'middleware' => 'admin.access'], function () {
                            Route::get('/', 'AdminController@index');
                            // Геймеры
                            Route::resource('gamers', 'GamerController');
                            Route::post('gamerScoreUpdate', 'GamerController@scoreUpdate');
                        });
                    </code>
                </pre>
            </section>

            <section>
                <h2>Контроллеры</h2>
                <pre>
                    <code class="hljs" data-trim contenteditable style="font-size: 16px;">
                        class FrontController extends Controller
                        {
                            public function openPost($id){
                                $post = Post::find($id);
                                $user = \Auth::user();
                                if (\Auth::guest() || !$user->hasBackendRight()) {
                                    $post->views = $post->views+1;
                                    $post->save();
                                }
                                $post->decodeHtmlContent();
                                return view('front.posts.show', ["post" => $post]);
                            }

                            public function news() {
                                $posts = Post::all();
                                foreach ($posts as $post) {
                                    $post->decodeHtmlContent();
                                }
                                $model = new NewsViewModel($posts);

                                return view('front.posts.index', ["model" => $model]);
                            }
                        }
                    </code>
                </pre>
            </section>

            <section>
                <h2>Шаблоны представления</h2>
                <img src="{{ asset('images/reveal/blade.png') }}" height="400">
            </section>

            <section>
                <h2>Шаблоны представления. Макет</h2>
                <img src="{{ asset('images/reveal/layout.png') }}" height="400">
            </section>

        </section>

        <section>
            <h2>Q & A</h2>
            <h4>Вопросы и ответы</h4>
        </section>
</div>

<script src="{{ asset('thirdparty/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/tether.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('thirdparty/reveal/js/head.min.js') }}"></script>
<script src="{{ asset('thirdparty/reveal/js/reveal.js') }}"></script>

<script>

    // More info https://github.com/hakimel/reveal.js#configuration
    Reveal.initialize({
        controls: true,
        progress: true,
        history: true,
        center: true,

        transition: 'slide', // none/fade/slide/convex/concave/zoom

        // More info https://github.com/hakimel/reveal.js#dependencies
        dependencies: [
            { src: 'thirdparty/reveal/js/classList.js', condition: function() { return !document.body.classList; } },
            { src: 'thirdparty/reveal/plugin/markdown/marked.js', condition: function() { return !!document.querySelector( '[data-markdown]' ); } },
            { src: 'thirdparty/reveal/plugin/markdown/markdown.js', condition: function() { return !!document.querySelector( '[data-markdown]' ); } },
            { src: 'thirdparty/reveal/plugin/highlight/highlight.js', async: true, callback: function() { hljs.initHighlightingOnLoad(); } },
            { src: 'thirdparty/reveal/plugin/zoom-js/zoom.js', async: true },
            { src: 'thirdparty/reveal/plugin/notes/notes.js', async: true }
        ]
    });

</script>

</body>
</html>