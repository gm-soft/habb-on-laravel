
@extends('layouts.front-layout')
@section('title', 'Habb - '.$post->title)

@section('content')
    <div class="container mt-2">

        <h1 class="">
            {{ $post->title }}
        </h1>
        <p class="uk-article-meta">
            Просмотров: {{ $post->views }}. Публикация: {{ $post->UpdatedAt() }}
        </p>
        <p>
            {!! $post->content  !!}
        </p>


        <hr>
        <div class="mt-2">
            <div>
                <a class="btn btn-link" href="{{ url('news') }}">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                    В список новостей
                </a>
            </div>
        </div>
    </div>

@endsection