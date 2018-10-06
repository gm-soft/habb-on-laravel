
@extends('layouts.front-layout')
@section('title', 'Новости портала')

    @php
        /** @var \App\ViewModels\NewsViewModel $model */
    @endphp

@section('content')

    <div class="container mt-2">

        <h1>Новости киберспорта</h1>

        @for($i = 0; $i < $model->postCount; $i++)

            @php
                /** @var \App\Models\Post $post */
                $post = $model->posts[$i];
                $url = url('news/'.$post->id)
            @endphp

        @if($i == 0 || $i % 3 == 0)
            <div class="row mt-2">
        @endif

                <div class="col-md-4 p-1">
                    <div class="card h-100">

                        <img class="card-img-top w-100" src="{{ asset($post->announce_image) }}" alt="">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{ $post->title }}
                            </h5>

                            <a href="{{ $url }}" class="card-link">Перейти</a>
                        </div>

                        <div class="card-footer">
                            <small class="text-muted">Просмотров: {{ $post->views }}</small>
                        </div>
                    </div>
                </div>



                @if($i == ($model->postCount - 1) || ($i - 2) % 3 == 0)
                    </div>
                @endif

        @endfor



    </div>

@endsection