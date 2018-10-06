
@extends('layouts.front-layout')
@section('title', 'Новости портала')

    @php
        /** @var \App\ViewModels\NewsViewModel $model */
    @endphp

@section('content')

    <div class="container mt-5">

        <h1>Новости киберспорта</h1>

        @for($i = 0; $i < $model->postCount; $i++)

            @php
                /** @var \App\Models\Post $post */
                $post = $model->posts[$i];
            @endphp

            @if($i == 0 || $i % 3 == 0)
                <div class="row mt-3">
            @endif

            @include('front.posts._post-announce', $post)

            @if($i == ($model->postCount - 1) || ($i - 2) % 3 == 0)
                </div>
            @endif

        @endfor



    </div>

@endsection