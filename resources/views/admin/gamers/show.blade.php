
@extends('layouts.admin-layout')
@section('title', 'Информация об игроке')

    @php
        /** @var \App\ViewModels\Back\GamerShowViewModel $model */
    @endphp

@section('content')
    <div class="container">
        <div class="mt-1">
            <h1>Игрок {{ $model->gamer->name }} {{ $model->gamer->last_name }} [HABB ID {{ $model->gamer->id }}]</h1>
            <p class="text-muted">Создание: {{ $model->gamer->created_at }}. Обновление: {{ $model->gamer->updated_at }}</p>
        </div>

        @if(!$model->gamer->is_active)
            <div class="mt-3 card border-danger">
                <div class="card-body">
                    <div class="card-text text-danger">
                        <p>
                            Аккаунт еще не был активирован. Пользователь этого аккаунта регистрировался только как участник ивента без указания своего HABB ID
                        </p>
                    </div>
            </div>
        @endif


        <div class="mt-3 card">
            <div class="card-body">
                <div class="card-text">

                    <div class="row">

                        <div class="col-sm-6">
                            <dl class="row">
                                <dt class="col-sm-3">Возраст</dt><dd class="col-sm-9">{{ $model->gamer->getGamerAge() }} лет  ({{ $model->gamer->getBirthday() }})</dd>
                                <dt class="col-sm-3">Телефон</dt><dd class="col-sm-9">{{ $model->gamer->phone }}</dd>
                                <dt class="col-sm-3">Email</dt><dd class="col-sm-9">{{ $model->gamer->email }}</dd>
                                <dt class="col-sm-3">Страница VK</dt><dd class="col-sm-9">{{ $model->gamer->vk_page }}</dd>
                                <dt class="col-sm-3">Город</dt><dd class="col-sm-9">{{ $model->gamer->city }}</dd>
                                <dt class="col-sm-3">Статус</dt><dd class="col-sm-9">{{ $model->gamer->status }}</dd>
                                <dt class="col-sm-3">Учреждение</dt><dd class="col-sm-9">{{ $model->gamer->institution }}</dd>

                            </dl>
                        </div>

                        <div class="col-sm-6">
                            <dl class="row">
                                <dt class="col-sm-3">Пользователь</dt><dd class="col-sm-9">{{ $model->gamer->gamer_id }}</dd>
                                <dt class="col-sm-3">Комментарий</dt><dd class="col-sm-9">{{ $model->gamer->comment }}</dd>
                                <dt class="col-sm-3">Основная игра</dt><dd class="col-sm-9">{{ $model->gamer->primary_game }}</dd>
                                <dt class="col-sm-3">Другие игры</dt><dd class="col-sm-9">{{ $model->gamer->getSecondaryGamesAsString() }}</dd>

                                <dt class="col-sm-3">Создан</dt><dd class="col-sm-9">{{ $model->gamer->created_at }}</dd>
                                <dt class="col-sm-3">Обновлен</dt><dd class="col-sm-9">{{ $model->gamer->updated_at }}</dd>

                                <dt class="col-sm-3">Класс</dt><dd class="col-sm-9">{{ $model->gamer->getClass() }}</dd>
                            </dl>
                        </div>

                    </div>

                </div>
            </div>
            <div class="card-footer">
                {{ link_to_action('GamerController@index', 'В список', [], ['class' => 'btn btn-light']) }}
                <div class="float-sm-right">

                    @if($model->gamer->is_active)
                        {{ link_to_action('GamerController@edit', 'Редактировать', ['id' => $model->gamer->id], ['class' => 'btn btn-primary']) }}
                    @endif
                    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteDialog">Удалить</button>
                </div>
            </div>
        </div>

        @if($model->teamsCount > 0)

            <div class="mt-3">

                <div class="">
                    Команды, где участвует игрок
                </div>

                <table class="table table-striped mt-2">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Название</th>
                        <th>Создана</th>
                    </tr>
                    </thead>
                    <tbody>
                    @for($index = 0; $index < $model->teamsCount; $index++)

                        @php($team = $model->teams[$index])
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $team->id }}</td>
                            <td><a href="{{ action('TeamController@show', ['id' => $team->id]) }}">{{ $team->name }}</a></td>
                            <td>{{ $team->created_at }}</td>
                        </tr>

                    @endfor
                    </tbody>

                </table>
            </div>

        @endif

    </div>

    <div class="modal fade" id="deleteDialog" tabindex="-1" role="dialog" aria-labelledby="deleteDialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Удаление объекта</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['method' =>'delete', 'action' => ['GamerController@destroy', $model->gamer->id]]) !!}
                <div class="modal-body">
                    Вы уверены, что хотите удалить запись об игроке #{{ $model->gamer->id }}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-outline-danger">Удалить</button>
                </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>

@endsection