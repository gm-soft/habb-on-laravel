
@extends('layouts.front-layout')
@section('title', 'HABB | '.$model->tournament->name)

@section('content')

    @if ($model->banners_count > 0)
        @include('front.home._banners-slider')
    @endif

    <div class="container">

        <div class="mt-5">
            <h1 class="display-4 ">{{ $model->tournament->name }}</h1>
        </div>

        <div class="row">
            <div class="col-md-8">
                {!! $model->tournament->public_description  !!}

                <div class="mt-1">
                    @include('shared._hashtags', ['hashtags' => $model->tournament->getHashtagsAsArray()])
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">

                    <div class="card-body">

                        <div class="card-title">
                            <h4>Связанные новости</h4>
                        </div>

                        @foreach($model->topNews as $topPost)

                            <div class="mt-2">
                                <a class="card-link habb-post-link" href="{{ action('HomeController@openPost', ['id' => $topPost->id]) }}">#{{ $topPost->title }}</a>
                            </div>

                        @endforeach

                        <div class="mt-3">
                            <a class="btn btn-link" href="{{ action('HomeController@news') }}">Все новости</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection

@section('styles')
    <style>
        {!! \App\Helpers\HtmlHelpers::getStylesForBannerSlider($model) !!}
    </style>
@endsection