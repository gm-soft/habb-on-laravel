
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
    <script src="https://cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content', { });

        var editor = {
            switchType : function(link) {
                var editor = $('#ckeditor');

            }
        }
    </script>
@endsection