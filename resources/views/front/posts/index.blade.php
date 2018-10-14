
@extends('layouts.front-layout')
@section('title', 'HABB | Новости')

    @php
        /** @var \App\ViewModels\NewsViewModel $model */
    @endphp

@section('content')

    <div class="container mt-5">

        <h1>{{ $model->pageTitle }}</h1>

        @if ($model->postCount == 0)

            <div class="display-4 mt-5 text-center">Новостей по запросу не найдено</div>
            <div class="display-4 mt-3 text-center">{{ \App\Helpers\Constants::NotFoundSmile }}</div>

        @else

            @for($i = 0; $i < $model->postCount; $i++)

                @php
                    /** @var \App\Models\Post $post */
                    $post = $model->posts[$i];
                @endphp

                @if($i == 0 || $i % 3 == 0)
                    <div class="row mt-3">
                        @endif

                        @include('front.posts._post-announce', ['post' => $model->posts[$i]])

                        @if($i == ($model->postCount - 1) || ($i - 2) % 3 == 0)
                    </div>
                @endif

            @endfor

        @endif
    </div>

@endsection