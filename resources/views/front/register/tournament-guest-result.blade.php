@extends('layouts.front-layout')
@section('title', 'HABB | Участвовать в ивенте')

@section('content')

    <div class="container">

        <div class="jumbotron">
            <h1 class="display-2">
                Поздравляем! Вы зарегистрированы как гость на ивенте, посвященном турниру <strong>"{{ $model->tournament->name }}"</strong>
            </h1>
            <hr>
            <p class="lead">
                Будем рады видеть вас на ивенте!
            </p>
        </div>

        <div class="mt-5">
            <a href="{{ action('HomeController@index') }}" class="btn btn-primary btn-lg btn-block">На главную страницу</a>
        </div>

    </div>

@endsection