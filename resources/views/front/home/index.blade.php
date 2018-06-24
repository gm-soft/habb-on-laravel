
@extends('layouts.front-layout')

@section('content')

    <div class="jumbotron jumbotron-fluid">
        <div class="container text-center">
            <h1 class="display-1">HABB</h1>
            <p class="lead">Сообщество геймеров Казахстана</p>
        </div>
    </div>

    <div class="container mt-3">

        <div class="row">

            <div class="col-sm-4 habb_home-option-block">
                <div class="card h-100">
                    <div class="card-body h-75">
                        <h4 class="card-title">Регистрация аккаунта</h4>
                        <p class="card-text">
                            Получите свой HABB ID сейчас
                        </p>
                    </div>
                    <div class="card-body">
                        <a href="{{ url('register/gamer') }}" class="btn btn-primary btn-block">Перейти</a>
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
                        <a href="{{ url('rating/gamers') }}" class="btn btn-primary btn-block">Перейти</a>
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
                        <a href="{{ url('rating/teams') }}" class="btn btn-primary btn-block">Перейти</a>
                    </div>
                </div>

            </div>


        </div>

    </div>




@endsection