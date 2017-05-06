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

        <section>
            <section>
                <h2>Назначение</h2>
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


        <section>
            <section>
                <h2>Цель проекта</h2>
                <div class="mt-3">
                    Разработка ПО для команды на базе веб-приложения, реализующее функции:
                </div>
                <ul>
                    <li>сбор</li>
                    <li>хранение</li>
                    <li>учет информации</li>
                </ul>
            </section>

            <section>
                <h4>Тип информации</h4>
                <p>
                    Данные игроков (электронные адреса и мобильные телефоны), команд, набранные ими очки.
                </p>
            </section>

            <section>
                <h4>Сбор информации</h4>
                <p>
                    Веб-формы, размещенные на портале
                </p>
                <div>
                    <img src="{{ asset('images/reveal/gamer-reg.png') }}" height="300">
                    <img src="{{ asset('images/reveal/team-reg.png') }}" height="300">
                </div>
            </section>

            <section>
                <h4>Хранение информации</h4>
                <p>
                    Базы данных системы
                </p>
                <ul>
                    <li>Собственная база данных</li>
                    <li>База CRM Битрикс24</li>
                </ul>
            </section>

            <section>
                <h4>Учет информации</h4>
                <p>
                    Использование одних данных для формирования других
                </p>
                <table>
                    <thead>
                        <tr>
                            <th>Игрок</th>
                            <th>Команда</th>
                            <th>Набранные очки</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Участие в команде</td>
                            <td>Состав участников</td>
                            <td>Присвоение командам и участникам</td>
                        </tr>

                        <tr>
                            <td>Участие в турнире</td>
                            <td>Участие в турнире</td>
                            <td>Формирование очков</td>
                        </tr>

                        <tr>
                            <td>Рейтинги игроков</td>
                            <td>Рейтинги команд</td>
                            <td>В основе рейтингов</td>
                        </tr>

                    </tbody>

                </table>
            </section>

        </section>

        <section>
            <h2>Принцип работы над проектом</h2>
            <ul>
                <li>Гибкий (итеративный) подход к разработке ПО</li>
                <li>Разработка MVP и последовательное создание нового функционала</li>
            </ul>
        </section>

        <section>
            <section>
                <h2>Два пути разработки</h2>
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
                    Наиболее полное исследование предмета/области. Жесткое и подробное техзадание.
                    Максимально полное тестирование. Планомерный процесс внедрения. Большие сроки.
                </p>
                <img src="{{ asset('images/reveal/waterfall.jpg') }}" width="400">
            </section>

            <section>
                <h4><u>Гибкая</u> модель разработки</h4>
                <p>
                    Исследование немного раньше начала разроботки и одновременно с ним. Небольшие техзадания на каждый цикл.
                    Получение жизнеспособного продукта на каждом этапе разработки. Тестирование внесенных изменений.
                </p>
                <img src="{{ asset('images/reveal/iterative.jpg') }}" width="400">
            </section>

            <section>
                <h4>Сравнение подходов</h4>
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Каскадная</th>
                            <th>Гибкая</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Техзадание</td>
                            <td>Подробное</td>
                            <td>На каждый цикл - свое небольшое</td>
                        </tr>

                        <tr>
                            <td>Сроки</td>
                            <td>Большие</td>
                            <td>Каждые 2-4 недели - готовый продукт</td>
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

        <section>
            <section>
                <h2>Требования к системе "Habb"</h2>
                <ul>
                    <li>Генерация данных</li>
                    <li>Хранение данных и CRUD-операции</li>
                    <li>Синхронизация данных</li>
                    <li>Автоматизация операций работы с данными</li>
                    <li>Публичный доступ к некоторым данным</li>
                </ul>
            </section>

            <section>
                <h4>Генерация данных</h4>
                <p>
                    Типы данных, которые собираются системой:
                </p>
                <ul>
                    <li>Телефоны, электронные адреса игроков</li>
                    <li>Команды игроков</li>
                    <li>Набранные очки игроками и командами</li>
                    <li>Турниры</li>
                </ul>
            </section>

            <section>
                <h4>Хранение данных</h4>
                <ul>
                    <li>Собственная база данных</li>
                    <li>База данных CRM (лиды)</li>
                </ul>
            </section>

            <section>
                <h4>Синхронизация данных</h4>
                <ul>
                    <li>Автоматическая запись ключевых данных игрока в базу CRM по его регистрации</li>
                    <li>Поддержка двухфакторной авторизации OAuth2.0</li>
                </ul>
            </section>

            <section>
                <h4>Автоматизация операций</h4>
                <ul>
                    <li>Автоматическая выдача Habb ID</li>
                    <li>Присвоение набранных очков игрокам</li>
                    <li>Присвоение очков команде с автоматическим повышением у игроков</li>
                    <li>Присвоение очков через турнир</li>
                    <li>Генерация рейтингов по очкам</li>
                </ul>
            </section>

            <section>
                <h4>Публичный доступ к данным</h4>
                <p>Данные в публичном доступе</p>
                <ul>
                    <li>Рейтинг игроков</li>
                    <li>Рейтинг команд</li>
                    <li>Новостные посты</li>
                </ul>
            </section>


        </section>



        <section data-markdown>
            <script type="text/template">
                ## Markdown support

                Write content using inline or external Markdown.
                Instructions and more info available in the [readme](https://github.com/hakimel/reveal.js#markdown).

                ```
                <section data-markdown>
                    ## Markdown support

                    Write content using inline or external Markdown.
                    Instructions and more info available in the [readme](https://github.com/hakimel/reveal.js#markdown).
                </section>
                ```
            </script>
        </section>

        <section>
            <section id="fragments">
                <h2>Fragments</h2>
                <p>Hit the next arrow...</p>
                <p class="fragment">... to step through ...</p>
                <p><span class="fragment">... a</span> <span class="fragment">fragmented</span> <span class="fragment">slide.</span></p>

                <aside class="notes">
                    This slide has fragments which are also stepped through in the notes window.
                </aside>
            </section>
            <section>
                <h2>Fragment Styles</h2>
                <p>There's different types of fragments, like:</p>
                <p class="fragment grow">grow</p>
                <p class="fragment shrink">shrink</p>
                <p class="fragment fade-out">fade-out</p>
                <p class="fragment fade-up">fade-up (also down, left and right!)</p>
                <p class="fragment current-visible">current-visible</p>
                <p>Highlight <span class="fragment highlight-red">red</span> <span class="fragment highlight-blue">blue</span> <span class="fragment highlight-green">green</span></p>
            </section>
        </section>

        <section id="transitions">
            <h2>Transition Styles</h2>
            <p>
                You can select from different transitions, like: <br>
                <a href="?transition=none#/transitions">None</a> -
                <a href="?transition=fade#/transitions">Fade</a> -
                <a href="?transition=slide#/transitions">Slide</a> -
                <a href="?transition=convex#/transitions">Convex</a> -
                <a href="?transition=concave#/transitions">Concave</a> -
                <a href="?transition=zoom#/transitions">Zoom</a>
            </p>
        </section>

        <section id="themes">
            <h2>Themes</h2>
            <p>
                reveal.js comes with a few themes built in: <br>
                <!-- Hacks to swap themes after the page has loaded. Not flexible and only intended for the reveal.js demo deck. -->
                <a href="#" onclick="document.getElementById('theme').setAttribute('href','css/theme/black.css'); return false;">Black (default)</a> -
                <a href="#" onclick="document.getElementById('theme').setAttribute('href','css/theme/white.css'); return false;">White</a> -
                <a href="#" onclick="document.getElementById('theme').setAttribute('href','css/theme/league.css'); return false;">League</a> -
                <a href="#" onclick="document.getElementById('theme').setAttribute('href','css/theme/sky.css'); return false;">Sky</a> -
                <a href="#" onclick="document.getElementById('theme').setAttribute('href','css/theme/beige.css'); return false;">Beige</a> -
                <a href="#" onclick="document.getElementById('theme').setAttribute('href','css/theme/simple.css'); return false;">Simple</a> <br>
                <a href="#" onclick="document.getElementById('theme').setAttribute('href','css/theme/serif.css'); return false;">Serif</a> -
                <a href="#" onclick="document.getElementById('theme').setAttribute('href','css/theme/blood.css'); return false;">Blood</a> -
                <a href="#" onclick="document.getElementById('theme').setAttribute('href','css/theme/night.css'); return false;">Night</a> -
                <a href="#" onclick="document.getElementById('theme').setAttribute('href','css/theme/moon.css'); return false;">Moon</a> -
                <a href="#" onclick="document.getElementById('theme').setAttribute('href','css/theme/solarized.css'); return false;">Solarized</a>
            </p>
        </section>

        <section>
            <section data-background="#dddddd">
                <h2>Slide Backgrounds</h2>
                <p>
                    Set <code>data-background="#dddddd"</code> on a slide to change the background color. All CSS color formats are supported.
                </p>
                <a href="#" class="navigate-down">
                    <img width="178" height="238" data-src="https://s3.amazonaws.com/hakim-static/reveal-js/arrow.png" alt="Down arrow">
                </a>
            </section>
            <section data-background="https://s3.amazonaws.com/hakim-static/reveal-js/image-placeholder.png">
                <h2>Image Backgrounds</h2>
                <pre><code class="hljs">&lt;section data-background="image.png"&gt;</code></pre>
            </section>
            <section data-background="https://s3.amazonaws.com/hakim-static/reveal-js/image-placeholder.png" data-background-repeat="repeat" data-background-size="100px">
                <h2>Tiled Backgrounds</h2>
                <pre><code class="hljs" style="word-wrap: break-word;">&lt;section data-background="image.png" data-background-repeat="repeat" data-background-size="100px"&gt;</code></pre>
            </section>
            <section data-background-video="https://s3.amazonaws.com/static.slid.es/site/homepage/v1/homepage-video-editor.mp4,https://s3.amazonaws.com/static.slid.es/site/homepage/v1/homepage-video-editor.webm" data-background-color="#000000">
                <div style="background-color: rgba(0, 0, 0, 0.9); color: #fff; padding: 20px;">
                    <h2>Video Backgrounds</h2>
                    <pre><code class="hljs" style="word-wrap: break-word;">&lt;section data-background-video="video.mp4,video.webm"&gt;</code></pre>
                </div>
            </section>
            <section data-background="http://i.giphy.com/90F8aUepslB84.gif">
                <h2>... and GIFs!</h2>
            </section>
        </section>

        <section data-transition="slide" data-background="#4d7e65" data-background-transition="zoom">
            <h2>Background Transitions</h2>
            <p>
                Different background transitions are available via the backgroundTransition option. This one's called "zoom".
            </p>
            <pre><code class="hljs">Reveal.configure({ backgroundTransition: 'zoom' })</code></pre>
        </section>

        <section data-transition="slide" data-background="#b5533c" data-background-transition="zoom">
            <h2>Background Transitions</h2>
            <p>
                You can override background transitions per-slide.
            </p>
            <pre><code class="hljs" style="word-wrap: break-word;">&lt;section data-background-transition="zoom"&gt;</code></pre>
        </section>

        <section>
            <h2>Pretty Code</h2>
            <pre><code class="hljs" data-trim contenteditable>
function linkify( selector ) {
  if( supports3DTransforms ) {

    var nodes = document.querySelectorAll( selector );

    for( var i = 0, len = nodes.length; i &lt; len; i++ ) {
      var node = nodes[i];

      if( !node.className ) {
        node.className += ' roll';
      }
    }
  }
}
					</code></pre>
            <p>Code syntax highlighting courtesy of <a href="http://softwaremaniacs.org/soft/highlight/en/description/">highlight.js</a>.</p>
        </section>

        <section>
            <h2>Marvelous List</h2>
            <ul>
                <li>No order here</li>
                <li>Or here</li>
                <li>Or here</li>
                <li>Or here</li>
            </ul>
        </section>

        <section>
            <h2>Fantastic Ordered List</h2>
            <ol>
                <li>One is smaller than...</li>
                <li>Two is smaller than...</li>
                <li>Three!</li>
            </ol>
        </section>

        <section>
            <h2>Tabular Tables</h2>
            <table>
                <thead>
                <tr>
                    <th>Item</th>
                    <th>Value</th>
                    <th>Quantity</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Apples</td>
                    <td>$1</td>
                    <td>7</td>
                </tr>
                <tr>
                    <td>Lemonade</td>
                    <td>$2</td>
                    <td>18</td>
                </tr>
                <tr>
                    <td>Bread</td>
                    <td>$3</td>
                    <td>2</td>
                </tr>
                </tbody>
            </table>
        </section>

        <section>
            <h2>Clever Quotes</h2>
            <p>
                These guys come in two forms, inline: <q cite="http://searchservervirtualization.techtarget.com/definition/Our-Favorite-Technology-Quotations">
                    &ldquo;The nice thing about standards is that there are so many to choose from&rdquo;</q> and block:
            </p>
            <blockquote cite="http://searchservervirtualization.techtarget.com/definition/Our-Favorite-Technology-Quotations">
                &ldquo;For years there has been a theory that millions of monkeys typing at random on millions of typewriters would
                reproduce the entire works of Shakespeare. The Internet has proven this theory to be untrue.&rdquo;
            </blockquote>
        </section>

        <section>
            <h2>Intergalactic Interconnections</h2>
            <p>
                You can link between slides internally,
                <a href="#/2/3">like this</a>.
            </p>
        </section>

        <section>
            <h2>Speaker View</h2>
            <p>There's a <a href="https://github.com/hakimel/reveal.js#speaker-notes">speaker view</a>. It includes a timer, preview of the upcoming slide as well as your speaker notes.</p>
            <p>Press the <em>S</em> key to try it out.</p>

            <aside class="notes">
                Oh hey, these are some notes. They'll be hidden in your presentation, but you can see them if you open the speaker notes window (hit 's' on your keyboard).
            </aside>
        </section>

        <section>
            <h2>Export to PDF</h2>
            <p>Presentations can be <a href="https://github.com/hakimel/reveal.js#pdf-export">exported to PDF</a>, here's an example:</p>
            <iframe data-src="https://www.slideshare.net/slideshow/embed_code/42840540" width="445" height="355" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" style="border:3px solid #666; margin-bottom:5px; max-width: 100%;" allowfullscreen> </iframe>
        </section>

        <section>
            <h2>Global State</h2>
            <p>
                Set <code>data-state="something"</code> on a slide and <code>"something"</code>
                will be added as a class to the document element when the slide is open. This lets you
                apply broader style changes, like switching the page background.
            </p>
        </section>

        <section data-state="customevent">
            <h2>State Events</h2>
            <p>
                Additionally custom events can be triggered on a per slide basis by binding to the <code>data-state</code> name.
            </p>
            <pre><code class="javascript" data-trim contenteditable style="font-size: 18px;">
Reveal.addEventListener( 'customevent', function() {
	console.log( '"customevent" has fired' );
} );
					</code></pre>
        </section>

        <section>
            <h2>Take a Moment</h2>
            <p>
                Press B or . on your keyboard to pause the presentation. This is helpful when you're on stage and want to take distracting slides off the screen.
            </p>
        </section>

        <section>
            <h2>Much more</h2>
            <ul>
                <li>Right-to-left support</li>
                <li><a href="https://github.com/hakimel/reveal.js#api">Extensive JavaScript API</a></li>
                <li><a href="https://github.com/hakimel/reveal.js#auto-sliding">Auto-progression</a></li>
                <li><a href="https://github.com/hakimel/reveal.js#parallax-background">Parallax backgrounds</a></li>
                <li><a href="https://github.com/hakimel/reveal.js#keyboard-bindings">Custom keyboard bindings</a></li>
            </ul>
        </section>

        <section style="text-align: left;">
            <h1>THE END</h1>
            <p>
                - <a href="http://slides.com">Try the online editor</a> <br>
                - <a href="https://github.com/hakimel/reveal.js">Source code &amp; documentation</a>
            </p>
        </section>

    </div>

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