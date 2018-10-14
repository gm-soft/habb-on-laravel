
@extends('layouts.front-layout')
@section('title', 'HABB | '.$model->pageTitle)
@section('content')

    <div class="container mt-5">

        <h1>{{ $model->staticPage->title }}</h1>

        <div class="mt-3">

            {!! $model->staticPage->content !!}

        </div>
    </div>
@endsection