
@extends('layouts.admin-layout')
@section('title', 'Информация об игроке')

@php
    /** @var \App\ViewModels\Back\UserShowViewModel $model */
@endphp

@section('content')
    <div class="container">
        <div class="mt-2">
            <h1>Пользователь {{ $model->user->email }} [{{ $model->user->id }}]</h1>
            <p class="text-muted">Создание: {{ $model->user->created_at }}. Обновление: {{ $model->user->updated_at }}</p>
            @if(!is_null($model->gamer))
                <p>Аккаунт игрока {{ $model->gamer->name }} {{ $model->gamer->last_name }} [ID {{ $model->gamer->id }}]</p>
            @endif
        </div>

        <div class="mt-2 card">
            <div class="card-block">

                <dl class="row">
                    <dt class="col-sm-3">Email</dt>
                    <dd class="col-sm-9">{{ $model->user->email }}</dd>

                    <dt class="col-sm-3">Роль</dt>
                    <dd class="col-sm-9">{{ $model->user->getRoleAsString() }}</dd>
                </dl>
            </div>
            <div class="card-footer">
                {{ link_to_action('UserController@index', 'В список', [], ['class' => 'btn btn-secondary']) }}
                <div class="float-sm-right">

                    {{ link_to_action('UserController@edit', 'Редактировать', ['id' => $model->user->id], ['class' => 'btn btn-primary']) }}
                    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteDialog">Удалить</button>
                </div>
            </div>


        </div>

        <div class="mt-1 card">
            <div class="card-block">
                <div class="card-text">
                    @if (!is_null($model->gamer))
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
                    @else
                        Аккаунт не был найден
                    @endif
                </div>
            </div>


        </div>
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
                {!! Form::open(['method' =>'delete', 'action' => ['UserController@destroy', $model->user->id]]) !!}
                <div class="modal-body">
                    Вы уверены, что хотите удалить запись об пользователе #{{ $model->user->id }}?
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