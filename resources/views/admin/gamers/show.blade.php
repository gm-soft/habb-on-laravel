
@extends('layouts.admin-layout')
@section('title', 'Информация об игроке')

@section('content')
    <div class="container">
        <div class="mt-1">
            <h1>Игрок {{ $gamer->name }} {{ $gamer->last_name }} [ID {{ $gamer->id }}]</h1>
            <p class="text-muted">Создание: {{ $gamer->created_at }}. Обновление: {{ $gamer->updated_at }}</p>
        </div>

        <div class="mt-1 card">
            <div class="card-block">
                <div class="card-text">

                    <div class="row">

                        <div class="col-sm-6">
                            <dl class="row">
                                <dt class="col-sm-3">Возраст</dt><dd class="col-sm-9">{{ $gamer->getGamerAge() }} лет  ({{ $gamer->getBirthday() }})</dd>
                                <dt class="col-sm-3">Телефон</dt><dd class="col-sm-9">{{ $gamer->phone }}</dd>
                                <dt class="col-sm-3">Email</dt><dd class="col-sm-9">{{ $gamer->email }}</dd>
                                <dt class="col-sm-3">Страница VK</dt><dd class="col-sm-9">{{ $gamer->vk_page }}</dd>
                                <dt class="col-sm-3">Город</dt><dd class="col-sm-9">{{ $gamer->city }}</dd>
                                <dt class="col-sm-3">Статус</dt><dd class="col-sm-9">{{ $gamer->status }}</dd>
                                <dt class="col-sm-3">Учреждение</dt><dd class="col-sm-9">{{ $gamer->institution }}</dd>

                            </dl>
                        </div>

                        <div class="col-sm-6">
                            <dl class="row">
                                <dt class="col-sm-3">Лид</dt><dd class="col-sm-9">{{ $gamer->lead_id }}</dd>
                                <dt class="col-sm-3">Комментарий</dt><dd class="col-sm-9">{{ $gamer->comment }}</dd>
                                <dt class="col-sm-3">Основная игра</dt><dd class="col-sm-9">{{ $gamer->primary_game }}</dd>
                                <dt class="col-sm-3">Другие игры</dt><dd class="col-sm-9">{{ $gamer->getSecondaryGamesAsString() }}</dd>

                                <dt class="col-sm-3">Создан</dt><dd class="col-sm-9">{{ $gamer->created_at }}</dd>
                                <dt class="col-sm-3">Обновлен</dt><dd class="col-sm-9">{{ $gamer->updated_at }}</dd>

                                <dt class="col-sm-3">Класс</dt><dd class="col-sm-9">{{ $gamer->getClass() }}</dd>
                            </dl>
                        </div>

                    </div>

                </div>
            </div>
            <div class="card-footer">
                {{ link_to_action('GamerController@index', 'В список', [], ['class' => 'btn btn-secondary']) }}
                <div class="float-sm-right">

                    {{ link_to_action('GamerController@edit', 'Редактировать', ['id' => $gamer->id], ['class' => 'btn btn-primary']) }}
                    {{ link_to_action('GamerController@destroy', 'Удалить', ['id' => $gamer->id], ['class' => 'btn btn-outline-danger']) }}
                </div>
            </div>
        </div>

        <div class="mt-1">
            @include('admin/gamers/score-table')
        </div>
    </div>

@endsection