
@extends('layouts.front-layout')
@section('title', 'Новости портала')

@section('content')

    <div class="uk-container uk-margin">
        @foreach($posts as $post)
            <div class="habb-post">
                <h1># {{ $post->title }}</h1>
                {!! $post->getContentShortly(600) !!}

                <div>

                    <i class="fa fa-eye" aria-hidden="true"></i> {{ $post->views }}
                    <div class="uk-float-right">
                        {{ link_to_action('FrontController@openPost', 'Подробнее', ['id'=>$post->id], ['class' => 'uk-button uk-button-text']) }}
                    </div>
                </div>
                <hr>
            </div>
        @endforeach
    </div>

@endsection