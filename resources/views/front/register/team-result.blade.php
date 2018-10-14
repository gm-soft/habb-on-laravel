@extends('layouts.front-layout')
@section('title', 'Регистрация заявки на команду')

@section('content')

    <div class="container">

        <div class="jumbotron">
            <h1 class="display-4">Заявка принята к обработке!</h1>
            <p class="lead">
                Номер заявки: <b>{{ $model->team_request->id }}</b> <br>
                Имя: {{ $model->team_request->requester_name }} ({{ $model->team_request->requester_phone }})<br>
                Email: {{ $model->team_request->requester_email }}
            </p>
            <hr>
            <p>
                Спасибо за регистрацию заявки на создание команды в нашем сообществе геймеров Казахстана.
                При утверждении заявки нашим менеджером Вы получите уведомление по электронной почте.
                Если заявка будет отлконена, Вы получите комментарий нашего менеджера.
            </p>
            <p>
                Заявка обычно рассматривается в течение пары дней, но срок рассмотрения может быть и дольше.
                В случае, если такое произошло, Вы можете узнать о статусе рассмотрения у администрации,
                указав уникальный номер заявки <b>{{ $model->team_request->id }}</b>
            </p>
        </div>

    </div>

@endsection