
@extends('layouts.mail-layout')

@section('content')
    <h1 class="email-title">Результат рассмотрения заявки</h1>

    <p>
        Здравствуйте! Наша команда рада, что Вы подали заявку #{{ $request->id }} на создание команды!
        Рады сообщить, что мы <b>утвердили</b> ее. Проверьте, пожалуйста, верность данных:
    </p>
    <div>
        <h3>Команда</h3>
        <ul>
            <li>ID команды: {{ $team->id }}</li>
            <li>Название: {{ $team->name }}</li>
            <li>Город: {{ $team->city }}</li>
        </ul>
        <h4>Состав команды</h4>
        <ul>
            @for($i = 0; $i < count($gamers); $i++)

                <li>
                    HABB ID: {{ $gamers[$i]->id }}. {{ $gamers[$i]->name." ".$gamers[$i]->last_name }}<br>
                    {{ $gamers[$i]->phone }}
                </li>
            @endfor
        </ul>

    </div>
    <p>
        С уважением, команда {{ config('app.name') }}!
    </p>
@endsection