@extends('layouts.front-layout')
@section('title', 'Регистрация игрока')

@section('content')

    <div class="uk-container">

        <div class="jumbotron">
            <h1 class="uk-heading-hero">HABB ID {{ $gamer->id }}</h1>
            <p class="uk-text-lead">
                Имя: {{ $gamer->name }} {{ $gamer->last_name }}<br>
                Email: {{ $gamer->email }}
            </p>
            <hr>
            <p>
                Спасибо за регистрацию в нашем сообществе геймеров Казахстана. Вам присвоен индивидуальный HABB ID,
                с помощью которого Вы можете принимать участие не только в общем рейтинге игроков и команд, но и в различных конкурсах,
                проводимых нашей командой =)
            </p>
        </div>

    </div>

@endsection