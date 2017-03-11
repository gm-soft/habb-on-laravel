
@extends('layouts.admin-layout')
@section('title', 'Создание поста')

@section('content')
    <div class="container">
        <h1 class="mt-1">Новая статья</h1>
        {!! Form::open(array('action' => array('PostController@store'))) !!}
        @include('admin/posts/form')
        {!! Form::close() !!}
    </div>


@endsection

@section('scripts')
    <script src="{{ asset('thirdparty/ckeditor/ckeditor.js') }}"></script>
    <script>
        ckEditorHelpers.replace('content');
    </script>
@endsection