
@extends('layouts.front-layout')
@section('title', 'Новости портала')

    @php
        /** @var \App\ViewModels\NewsViewModel $model */
    @endphp

@section('content')

    <div class="uk-container uk-margin">
        @for($i = 0; $i < count($model->news);$i++)

            @php
                /** @var \App\Models\Post $post */
                $post = $model->posts[$i];
                $url = url('news/'.$post->id)
            @endphp

            <div class="habb-post">
                <a href="{{ $url }}" class="h1 uk-button-text"># {{ $post->title }}</a>
                {!! $post->getContentShortly(400) !!}

                <div>

                    <i class="fa fa-eye" aria-hidden="true"></i> {{ $post->views }}
                    <div class="uk-float-right">
                        <a href="{{ $url }}" class="uk-button uk-button-text">Подробнее</a>
                    </div>
                </div>
                <hr>
            </div>
        @endfor
    </div>

@endsection