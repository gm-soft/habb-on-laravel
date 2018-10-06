
@extends('layouts.front-layout')
@section('title', 'HABB | '.$model->post->title)

@section('content')

    <div class="container mt-5">

        <h1 class="display-4">{{ $model->post->title }}</h1>

        <div class="my-3 text-muted">
            Просмотров: {{ $model->post->views }}. Публикация: {{ $model->post->UpdatedAt() }}
        </div>

        <div class="row">
            <div class="col-md-8">
                {!! $model->post->content  !!}
            </div>

            <div class="col-md-4">
                <div class="card">

                    <div class="card-body">

                        <div class="card-title">
                            <h4>Другие новости</h4>
                        </div>

                        @if($model->hasAnotherPosts)

                            @foreach($model->topPosts as $topPost)

                                <div class="mt-2">
                                    <a class="card-link habb-post-link" href="{{ action('HomeController@openPost', ['id' => $topPost->id]) }}">#{{ $topPost->title }}</a>
                                </div>

                            @endforeach

                        @endif

                        <div class="mt-3">
                            <a class="btn btn-link" href="{{ action('HomeController@news') }}">Все новости</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection