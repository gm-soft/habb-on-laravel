@extends('layouts.front-layout')
@section('title', 'Регистрация игрока')

@section('content')

    <div class="container">

        <div class="jumbotron">
            <h1 class="display-2">HABB ID {{ $gamer->id }}</h1>
            <p class="lead">
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