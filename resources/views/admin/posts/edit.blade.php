
@extends('layouts.admin-layout')
@section('title', 'Редактирование статьи')

@section('content')
    <div class="container">
        <h1 class="mt-1">Редактирование статьи [{{ $post->id }}]</h1>
        {!! Form::model($post, ['method' => 'PATCH', 'action' => ['PostController@update', $post->id]]) !!}
        @include('admin/posts/form')
        {!! Form::close() !!}
    </div>


@endsection

@section('styles')
@endsection

@section('scripts')
    <script src="{{ asset('thirdparty/ckeditor/ckeditor.js') }}"></script>
    <script>
        ckEditorHelpers.replace('content');
    </script>
@endsection