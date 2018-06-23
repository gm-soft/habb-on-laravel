
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
                <dd class="col-sm-9 apiKey__tag">{{ $model->api_key }}</dd>

            </dl>
        </div>
        <hr>
        <div class="">
            <div class="row">
                <div class="col-sm-9">
                    <i class="fa fa-plus" aria-hidden="true"></i> Создан {{ $model->UpdatedAt() }}.
                    <i class="fa fa-pencil" aria-hidden="true"></i> Обновлен {{ $model->CreatedAt() }}
                </div>

            </div>
        </div>
        <div class="mt-1">
            <div class="row">
                <div class="col-sm-6">
                    {{ link_to_action('ExternalServicesController@index', 'В список', null, ['class' => 'btn btn-secondary']) }}
                </div>

                <div class="col-sm-6 text-sm-right">
                    <button type="button" class="btn btn-outline-secondary changeApiKeyBtn__tag">Сменить API KEY</button>

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

@section('scripts')

    <script>
        $(function(){

            $(".changeApiKeyBtn__tag").click(function(){
                var url = "{{ action('ExternalServicesController@updateApiKey') }}";
                var data = {
                    id : {{ $model->id }}
                };
                habb.utils.AjaxRequest(url, data, function(response){
                    $(".apiKey__tag").html(response.api_key);
                })
            });

        });
    </script>

@endsection