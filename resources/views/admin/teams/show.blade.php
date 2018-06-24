
@extends('layouts.admin-layout')
@section('title', 'Информация об команде')

@section('content')
    <div class="container">
        <div class="mt-1">
            <h1 class="mt-1">Команда {{ $team->name }} [ID {{ $team->id }}]</h1>
            <p class="text-muted">Создание: {{ $team->created_at }}. Обновление: {{ $team->updated_at }}</p>
        </div>


        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-text">
                            <dl class="row">
                                <dt class="col-sm-4">Участники</dt>     <dd class="col-sm-8">{{ $team->getGamerIdsAsString() }}</dd>
                                <dt class="col-sm-4">Город</dt>         <dd class="col-sm-8">{{ $team->city }}</dd>
                                <dt class="col-sm-4">Комментарий</dt>   <dd class="col-sm-8">{{ $team->comment }}</dd>
                            </dl>
                        </div>

                    </div>
                    <div class="card-footer">
                        {{ link_to_action('TeamController@index', 'В список', [], ['class' => 'btn btn-light']) }}
                        <div class="float-sm-right">

                            {{ link_to_action('TeamController@edit', 'Редактировать', ['id' => $team->id], ['class' => 'btn btn-primary']) }}
                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteDialog">Удалить</button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-sm-6">
                @include('admin/teams/team-participants')
            </div>

        </div>

        <div class="mt-1">
            @include('admin/teams/score-table')
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
                {!! Form::open(['method' =>'delete', 'action' => ['TeamController@destroy', $team->id]]) !!}
                <div class="modal-body">
                    Вы уверены, что хотите удалить запись о команде #{{ $team->id }}?
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