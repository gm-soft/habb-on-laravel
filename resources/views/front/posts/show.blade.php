
@extends('layouts.front-layout')
@section('title', 'Habb - '.$post->title)

@section('content')

    <div class="container mt-2">

        <h1 class="display-4">{{ $post->title }}</h1>

        <div class="my-3 text-muted">
            Просмотров: {{ $post->views }}. Публикация: {{ $post->UpdatedAt() }}
        </div>

        <div class="row">
            <div class="col-md-8">
                {!! $post->content  !!}
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-link" href="{{ url('news') }}">
                            <i class="fa fa-chevron-left" aria-hidden="true"></i>
                            В список новостей
                        </a>
                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection