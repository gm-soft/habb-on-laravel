
@extends('layouts.admin-layout')
@section('title', 'Информация о статье')

@section('content')
    <div class="container mt-3">

        <div class="">
            <h1 class="display-4">{{ $post->title }}</h1>

            <p class="text-muted">Создана: {{ $post->CreatedAt() }}. Обновлена: {{ $post->UpdatedAt() }}</p>
        </div>

        <div class="mt-3 row">

            <div class="col-md-8">
                {!! $post->content !!}
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="">
                            Картинка для анонса:
                            <br>
                            <img class="w-100" src="{{ $post->announce_image }}" />
                        </div>

                        <div class="mt-2">
                            Просмотры <i class="fa fa-eye" aria-hidden="true"></i> {{ $post->views }}
                        </div>

                        <div class="mt-1">
                            {{ link_to_action('PostController@index', 'В список', null, ['class' => 'btn btn-light']) }}
                        </div>

                        <div class="mt-1">
                            {{ link_to_action('PostController@edit', 'Редактировать', ['id' => $post->id], ['class' => 'btn btn-primary']) }}
                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteDialog">Удалить</button>
                        </div>

                    </div>

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