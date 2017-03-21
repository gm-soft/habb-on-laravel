
@extends('layouts.admin-layout')
@section('title', 'Информация о статье')

@section('content')
    <div class="container">
        <div class="mt-1">
            <h1>Пара "{{ $instance->key }}" [ID {{ $instance->id }}]</h1>
            <p class="text-muted">Создание: {{ $instance->created_at }}. Обновление: {{ $instance->updated_at }}</p>
        </div>


        <div class="mt-1">
            {!! $instance->value !!}
        </div>
        <hr>
        <div class="mt-1">
            <div class="row">
                <div class="col-sm-6">
                    {{ link_to_action('KeyValueController@index', 'В список', null, ['class' => 'btn btn-secondary']) }}
                </div>

                <div class="col-sm-6 text-sm-right">
                    {{ link_to_action('KeyValueController@edit', 'Редактировать', ['id' => $instance->id], ['class' => 'btn btn-primary']) }}
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
                {!! Form::open(['method' =>'delete', 'action' => ['KeyValueController@destroy', $instance->id]]) !!}
                <div class="modal-body">
                    Вы уверены, что хотите удалить пару #{{ $instance->id }}?<br>
                    <i>Это действиет необратимое</i>
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