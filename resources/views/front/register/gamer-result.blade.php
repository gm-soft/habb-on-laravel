@extends('layouts.front-layout')
@section('title', 'Регистрация игрока')

@section('content')

    <div class="container">

        <div class="jumbotron">
            <h1 class="display-2">HABB ID {{ $model->gamer->id }}</h1>
            <p class="lead">
                Имя: {{ $model->gamer->name }} {{ $model->gamer->last_name }}<br>
                Email: {{ $model->gamer->email }}
            </p>
            <hr>
            <p>
                Спасибо за регистрацию в нашем сообществе геймеров Казахстана. Вам присвоен индивидуальный HABB ID,
                с помощью которого Вы можете принимать участие не только в общем рейтинге игроков и команд, но и в различных конкурсах,
                проводимых нашей командой =)
            </p>
        </div>

        <div class="mt-5">
            <a href="{{ action('HomeController@index') }}" class="btn btn-primary btn-lg btn-block">На главную страницу</a>
        </div>

    </div>

@endsection