@extends('layouts.front-layout')
@section('title', 'HABB | Рагистрация команды')

@section('content')

    <div class="container">

        <div class="jumbotron">
            <h1 class="display-2">
                Команда {{ $model->team->name }} зарегистрирована!
            </h1>
            <hr>
            <p class="lead">
                Айди вашей команды <b>{{ $model->team->id }}</b>. Замена игроков возможна только до окончания регистрации на турнир!
            </p>
        </div>

        <div class="mt-5">
            <a href="{{ action('HomeController@index') }}" class="btn btn-primary btn-lg btn-block">На главную страницу</a>
        </div>

    </div>

@endsection