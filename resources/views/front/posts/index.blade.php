
@extends('layouts.front-layout')
@section('title', 'Новости портала')

    @php
        /** @var \App\ViewModels\NewsViewModel $model */
    @endphp

@section('content')

    <div class="uk-container uk-margin">

        <h1>Новости портала</h1>

        @for($i = 0; $i < count($model->posts);$i++)

            @php
                /** @var \App\Models\Post $post */
                $post = $model->posts[$i];
                $url = url('news/'.$post->id)
            @endphp

            <div class="habb-post">
                <div class="">
                    <a href="{{ $url }}" class="h2 uk-button uk-button-text"># {{ $post->title }}</a>
                </div>

                <div class="uk-margin">
                    {!! $post->getContentShortly(400) !!}
                </div>


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