
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
            <a href="{{ url('register/gamer') }}" class="btn btn-lg btn-primary btn-block home-page-registration-btn pt-3">
                <span class="h3">Получить HABB ID</span>
            </a>
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