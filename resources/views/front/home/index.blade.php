
@extends('layouts.front-layout')

@section('content')

    <div id="carouselExampleIndicators" class="carousel slide w-100" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">

                <div class="slider-block slider-bg-grey habb-slider-block habb-slider-block-first">
                    <div class="habb-overlay"></div>

                    <div class="carousel-caption habb-carousel-caption">
                        <h1 class="display-1">HABB</h1>
                        <p>Сообщество геймеров Казахстана</p>
                    </div>
                </div>

            </div>
            <div class="carousel-item">
                <div class="slider-block slider-bg-grey habb-slider-block habb-slider-block-second">
                    <div class="habb-overlay"></div>

                    <div class="carousel-caption habb-carousel-caption">
                        <div class="h1 display-3">Новости</div>
                        <p>Мы рассказываем о самых интересных киберспортивных мероприятиях Казахстана</p>
                    </div>
                </div>

            </div>
            <div class="carousel-item">
                <div class="slider-block slider-bg-grey habb-slider-block habb-slider-block-third">
                    <div class="habb-overlay"></div>

                    <div class="carousel-caption habb-carousel-caption">
                        <div class="h1 display-3">Регистрация HABB ID</div>
                        <p>У нас вы можете получить HABB ID и участвовать с ним в турнирах</p>
                    </div>
                </div>

            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Назад</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Вперед</span>
        </a>
    </div>

    <div class="container">

        <div class="mt-5">
            <p>
                HABB — это не только киберспортивная организация, но и сообщество геймеров Казахстана​</p>
            <p>
                Мы хотим объединить всех неравнодушных людей к молодой, но весьма насыщенной вселенной — киберспорт!
                Будь то игроки, зрители и все, кто видит в гейминге возможность профессионального роста и готов шагать в ногу с современным ритмом кибер-сферы.
                Индустрия кибероспорта стремительно разрастается с каждым часом — событий всё больше, новости всё интереснее!
            ​</p>

            <p>
                Быть в курсе всего вам поможет HABB — пространство, в котором вы не упустите ни одной интересной новости в империи киберспорта.
                Рейтинг казахстанских игроков, да что там, — Киберспортсменов!
            </p>
            <p>
                Мы с радостью и даже с жаждой приветствуем все идеи, которые связаны с киберспортом и его развитием!
            </p>
        </div>

        <div class="mt-5">
            <a href="{{ url('register/gamer') }}" class="btn btn-lg btn-primary btn-block home-page-registration-btn pt-3">
                <span class="h3">Получить HABB ID</span>
            </a>
        </div>


        <div class="mt-5">
            <div class="text-center display-4 my-3">Последние новости сообщества</div>

            <div class="mt-3 row">

                @for($index = 0; $index < $model->topPostCount; $index++)

                    @php
                        $post = $model->posts[$index]
                    @endphp

                    @include('front.posts._post-announce')

                @endfor

            </div>

        </div>

    </div>
@endsection

@section('styles')

    <style>
        .habb-slider-block-first {
            background: url({{ url('storage/dote2.jpg') }}) no-repeat center;
        }

        .habb-slider-block-second {
            background: url({{ url('storage/cybersport.jpg') }}) no-repeat center;
        }

        .habb-slider-block-third {
            background: url({{ url('storage/tihall.jpg') }}) no-repeat center;
        }
    </style>

@endsection