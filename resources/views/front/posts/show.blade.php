
@extends('layouts.front-layout')
@section('title', 'Habb - '.$post->title)

@section('content')
    <div class="uk-container">

        <article class="uk-article">
            <h1 class="uk-article-title">
                {{ $post->title }}
            </h1>
            <p class="uk-article-meta">
                Просмотров: {{ $post->views }}. Публикация: {{ $post->UpdatedAt() }}
            </p>
            <p>
                {!! $post->content  !!}
            </p>
        </article>
        <hr>
        <div class="uk-grid-small uk-child-width-auto" uk-grid>
            <div>
                <a class="uk-button uk-button-text" href="{{ url('news') }}"><i class="fa fa-chevron-left" aria-hidden="true"></i> В список новостей</a>
            </div>
        </div>
    </div>

@endsection