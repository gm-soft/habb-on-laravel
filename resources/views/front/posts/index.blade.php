
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

                        <!--img class="card-img-top" src="..." alt="Card image cap"-->
                        <div class="card-body">
                            <h5 class="card-title text-truncate">
                                {{ $post->title }}
                            </h5>
                            <h6 class="card-subtitle small mb-2 text-muted">
                                Просмотров: {{ $post->views }}
                            </h6>
                            <p class="card-text">
                                {!! $post->getContentShortly(150) !!}
                            </p>

                            <a href="{{ $url }}" class="card-link">Перейти</a>
                        </div>
                    </div>
                </div>



                @if($i == ($model->postCount - 1) || ($i - 2) % 3 == 0)
                    </div>
                @endif

        @endfor



    </div>

@endsection