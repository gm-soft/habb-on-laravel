
@extends('layouts.front-layout')
@section('title', 'Habb - '.$post->title)

@section('content')

    <div class="jumbotron jumbotron-fluid habb-bg-cover jumbotron-cover">
        <div class="habb-overlay"></div>
        <div class="container mt-5">
            <h1 class="display-4">{{ $post->title }}</h1>
        </div>
    </div>

    <div class="container mt-2">

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

@section("styles")
    <style type="text/css">
        .jumbotron-cover {
            background: url("http://disgustingmen.com/wp-content/uploads/2016/08/cybersport.jpg") fixed no-repeat center;
        }
    </style>
@endsection