
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
                    <div class="card-block">
                        <div class="card-text">
                            <dl class="row">
                                <dt class="col-sm-4">Участники</dt>     <dd class="col-sm-8">{{ $team->getGamerIdsAsString() }}</dd>
                                <dt class="col-sm-4">Город</dt>         <dd class="col-sm-8">{{ $team->city }}</dd>
                                <dt class="col-sm-4">Комментарий</dt>   <dd class="col-sm-8">{{ $team->comment }}</dd>
                            </dl>
                        </div>

                    </div>
                    <div class="card-footer">
                        {{ link_to_action('TeamController@index', 'В список', [], ['class' => 'btn btn-secondary']) }}
                        <div class="float-sm-right">

                            {{ link_to_action('TeamController@edit', 'Редактировать', ['id' => $team->id], ['class' => 'btn btn-primary']) }}
                            {{ link_to_action('TeamController@destroy', 'Удалить', ['id' => $team->id], ['class' => 'btn btn-outline-danger']) }}
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

@endsection