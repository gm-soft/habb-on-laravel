
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
                    {{ link_to_action('PostController@index', 'В список', null, ['class' => 'btn btn-secondary']) }}
                </div>

                <div class="col-sm-6 text-sm-right">
                    {{ link_to_action('PostController@edit', 'Редактировать', ['id' => $post->id], ['class' => 'btn btn-primary']) }}
                    {{ link_to_action('PostController@destroy', 'Удалить', ['id' => $post->id], ['class' => 'btn btn-outline-danger']) }}
                </div>

            </div>
        </div>
    </div>

@endsection