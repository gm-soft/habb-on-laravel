
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

                <div class="slider-block slider-bg-grey">
                    <div class="carousel-caption">
                        <h1 class="display-1">HABB</h1>
                        <p>Сообщество геймеров Казахстана</p>
                    </div>
                </div>

            </div>
            <div class="carousel-item">
                <div class="slider-block slider-bg-grey">
                    <div class="carousel-caption">
                        <div class="h1 display-3">Новости</div>
                        <p>Мы рассказываем о самых интересных киберспортивных мероприятиях Казахстана</p>
                    </div>
                </div>

            </div>
            <div class="carousel-item">
                <div class="slider-block slider-bg-grey">
                    <div class="carousel-caption">
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

    <div class="container mt-3">

        <div class="row">

            <div class="col-sm-4 habb_home-option-block">
                <div class="card h-100">
                    <div class="card-body h-75">
                        <h4 class="card-title">Новости сообщества</h4>
                        <p class="card-text">
                            Будьте в курсе всех событий мира киберспорта
                        </p>
                    </div>
                    <div class="card-body">
                        <a href="{{ url('/news') }}" class="btn btn-light btn-block">Перейти</a>
                    </div>
                </div>

            </div>

            <div class="col-sm-4 habb_home-option-block">
                <div class="card h-100">
                    <div class="card-body h-75">
                        <h4 class="card-title">Личный рейтинг</h4>
                        <p class="card-text">
                            Попробуйте попасть в топ 10 игроков!
                        </p>
                    </div>
                    <div class="card-body">
                        <a href="{{ url('rating/gamers') }}" class="btn btn-light btn-block">Перейти</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 habb_home-option-block">
                <div class="card h-100">
                    <div class="card-body h-75">
                        <h4 class="card-title">Командный рейтинг</h4>
                        <p class="card-text">
                            Вы можете ознакомиться с топовыми командами нашей страны
                        </p>
                    </div>
                    <div class="card-body">
                        <a href="{{ url('rating/teams') }}" class="btn btn-light btn-block">Перейти</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ url('register/gamer') }}" class="btn btn-lg btn-primary btn-block home-page-registration-btn pt-3">
                <span class="h3">Получить HABB ID</span>
            </a>
        </div>

    </div>




@endsection