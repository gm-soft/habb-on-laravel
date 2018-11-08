
@extends('layouts.front-layout')

@section('content')

    @include('front.home._banners-slider')

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
            <a href="{{ action('GamerController@registerForm', ['from' => 'main_page']) }}" class="btn btn-lg btn-primary btn-block home-page-registration-btn pt-3">
                <span class="h3">Получить HABB ID</span>
            </a>
        </div>


        <div class="mt-5">
            <div class="text-center display-4 my-3">Последние новости сообщества</div>
            <div class="mt-3 row">

                @for($index = 0; $index < $model->posts_count; $index++)

                    @php
                        $post = $model->posts[$index]
                    @endphp

                    @include('front.posts._post-announce')

                @endfor

            </div>

            <div class="mt-3">
                <a href="{{ action('HomeController@news') }}" class="btn btn-lg btn-light btn-block home-page-registration-btn pt-3">
                    <span class="h3">Все новости киберспорта</span>
                </a>
            </div>

        </div>

    </div>
@endsection

@section('styles')
    <style>
        {!! \App\Helpers\HtmlHelpers::getStylesForBannerSlider($model) !!}

    </style>
@endsection