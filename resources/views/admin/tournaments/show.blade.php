
@extends('layouts.admin-layout')
@section('title', 'Информация о турнире')

@section('content')
    <div class="container">
        <div class="mt-1">
            <h1 class="mt-1">Турнир {{ $instance->name }} [ID {{ $instance->id }}]</h1>
            <p class="text-muted">Создание: {{ $instance->created_at }}. Обновление: {{ $instance->updated_at }}</p>
        </div>

        <div class="row">
            <div class="col-sm-8">
                <dl>
                    <dt>Публичное описание</dt>
                    <dd>{{ $instance->public_description }}</dd>

                    <dt>Тип турнира</dt>
                    <dd>{{ $instance->tournament_type }}</dd>

                    <dt>Максимальное кол-во участников</dt>
                    <dd>{{ $instance->participant_max_count }}</dd>

                    <dt>Игровая дисциплина</dt>
                    <dd>{{ $instance->game ?? 'Не определена' }}</dd>

                    <dt>Начало турнира</dt>
                    <dd>{{ $instance->started_at }}</dd>

                    <dt>Регистрация закрывается</dt>
                    <dd>{{ $instance->reg_closed_at }}</dd>

                    <dt>Комментарий</dt>
                    <dd>{{ $instance->comment ?? 'Без комментарий' }}</dd>
                </dl>

            </div>
            <div class="col-sm-4">
                {{ link_to_action('TournamentController@index', 'В список', [], ['class' => 'btn btn-light']) }}
                <div class="float-sm-right">

                    {{ link_to_action('TournamentController@edit', 'Редактировать', ['id' => $instance->id], ['class' => 'btn btn-primary']) }}
                    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteDialog">Удалить</button>
                </div>
            </div>
        </div>
        <div class="mt-1">
            @include('admin.tournaments.participant-table')
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
                {!! Form::open(['method' =>'delete', 'action' => ['TournamentController@destroy', $instance->id]]) !!}
                <div class="modal-body">
                    Вы уверены, что хотите удалить запись о турнире #{{ $instance->id }}?
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