
@extends('layouts.front-layout')
@section('title', 'Новости портала')

    @php
        /** @var \App\ViewModels\NewsViewModel $model */
    @endphp

@section('content')

    <div class="uk-container uk-margin">

        <h1>Новости портала</h1>

        <div class="uk-child-width-1-3@m uk-grid-medium uk-grid-match" uk-grid>

            @for($i = 0; $i < count($model->posts);$i++)

                @php
                    /** @var \App\Models\Post $post */
                    $post = $model->posts[$i];
                    $url = url('news/'.$post->id)
                @endphp

            <div>
                <div class="uk-card uk-card-default uk-card-body">
                    <div class="uk-card-title uk-text-left">
                        <a href="{{ $url }}" class="h2 uk-button uk-button-text uk-text-left">#{{ $post->title }}</a>
                    </div>
                    <div class="uk-flex uk-flex-between">
                        <div>
                            <i class="fa fa-eye" aria-hidden="true"></i> {{ $post->views }}
                        </div>
                        <div>
                            01.01.12
                        </div>
                    </div>
                    <div class="uk-margin">
                        {!! $post->getContentShortly(400) !!}
                    </div>

                </div>
            </div>

            @endfor


        </div>



    </div>

@endsection