
@extends('layouts.admin-layout')
@section('title', 'Информация о статье')

@section('content')
    <div class="container">
        <div class="mt-1">
            <h1>Статья "{{ $post->title }}" [ID {{ $post->id }}]</h1>
            <p class="text-muted">Создание: {{ $post->created_at }}. Обновление: {{ $post->updated_at }}</p>
        </div>


        <div class="mt-1">
            {!! $post->content !!}
        </div>
        <hr>
        <div class="">
            <div class="row">
                <div class="col-sm-3">
                    Просмотры <i class="fa fa-eye" aria-hidden="true"></i> {{ $post->views }}
                </div>

                <div class="col-sm-9 text-sm-right">
                    <i class="fa fa-plus" aria-hidden="true"></i> Создание {{ $post->UpdatedAt() }}.
                    <i class="fa fa-pencil" aria-hidden="true"></i> Обновление {{ $post->CreatedAt() }}
                </div>

            </div>
        </div>
        <div class="mt-1">
            <div class="row">
                <div class="col-sm-6">
                    {{ link_to_action('PostController@index', 'В список', null, ['class' => 'btn btn-light']) }}
                </div>

                <div class="col-sm-6 text-sm-right">
                    {{ link_to_action('PostController@edit', 'Редактировать', ['id' => $post->id], ['class' => 'btn btn-primary']) }}
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
                {!! Form::open(['method' =>'delete', 'action' => ['PostController@destroy', $post->id]]) !!}
                <div class="modal-body">
                    Вы уверены, что хотите удалить пост #{{ $post->id }}?
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