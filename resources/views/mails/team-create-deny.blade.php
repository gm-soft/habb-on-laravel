
@extends('layouts.mail-layout')

@section('content')
    <h1 class="email-title">Результат рассмотрения заявки</h1>

    <p>
        Здравствуйте! Наша команда рада, что Вы подали заявку #{{ $request->id }} на создание команды,
        однако вынуждены сообщить, что заявка <b>отклонена</b>. Наш менеджер указал следующую причину:
        <br>
        <i>{{ $message }}</i>
    </p>
    <div>
        <h3>Инфоррмация по заявке</h3>
        <ul>
            <li>Название: {{ $request->name }}</li>
            <li>Город: {{ $request->city }}</li>
        </ul>
        <h4>Состав команды</h4>
        <ul>
            @for($i = 0; $i < count($request->participant_ids); $i++)

                <li>
                    HABB ID: {{ $request->participant_ids[$i] }}. {{ $request->participant_names[$i] }}<br>
                </li>
            @endfor
        </ul>

    </div>
    <p>
        С уважением, команда {{ config('app.name') }}!
    </p>
@endsection