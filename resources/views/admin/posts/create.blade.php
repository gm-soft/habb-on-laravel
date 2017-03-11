
@extends('layouts.admin-layout')
@section('title', 'Создание поста')

@section('content')
    <h1 class="mt-1">Новая статья</h1>
    <div class="">
        {!! Form::open(array('action' => array('PostController@store'))) !!}
            @include('admin/posts/form')
        {!! Form::close() !!}
    </div>


@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content', { });
    </script>
@endsection