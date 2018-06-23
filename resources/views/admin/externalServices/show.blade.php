
@extends('layouts.admin-layout')
@section('title', 'Информация о статье')

@php
    /** @var \App\Models\ExternalService $model */
@endphp

@section('content')
    <div class="container">
        <div class="mt-1">
            <h1>Внешний сервис "{{ $model->title }}" [ID:{{ $model->id }}]</h1>
        </div>
        <div class="mt-1">
            <dl class="row">
                <dt class="col-sm-3">Комментарий</dt>
                <dd class="col-sm-9">{{ $model->comment }}</dd>

                <dt class="col-sm-3">API KEY</dt>
                <dd class="col-sm-9">{{ $model->api_key }}</dd>

            </dl>
        </div>
        <hr>
        <div class="">
            <div class="row">
                <div class="col-sm-9 text-sm-right">
                    <i class="fa fa-plus" aria-hidden="true"></i> Создание {{ $model->UpdatedAt() }}.
                    <i class="fa fa-pencil" aria-hidden="true"></i> Обновление {{ $model->CreatedAt() }}
                </div>

            </div>
        </div>
        <div class="mt-1">
            <div class="row">
                <div class="col-sm-6">
                    {{ link_to_action('ExternalServicesController@index', 'В список', null, ['class' => 'btn btn-secondary']) }}
                </div>

                <div class="col-sm-6 text-sm-right">
                    {{ link_to_action('ExternalServicesController@edit', 'Редактировать', ['id' => $model->id], ['class' => 'btn btn-primary']) }}
                    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteDialog">Удалить</button>
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
                {!! Form::open(['method' =>'delete', 'action' => ['ExternalServicesController@destroy', $model->id]]) !!}
                <div class="modal-body">
                    Вы уверены, что хотите удалить пост #{{ $model->id }}?
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