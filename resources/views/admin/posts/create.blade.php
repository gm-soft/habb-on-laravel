
@extends('layouts.admin-layout')
@section('title', 'Создание поста')

@section('content')
    <div class="container">
        <h1 class="mt-1">Новая статья</h1>
        {!! Form::open(['action' => ['PostController@store']]) !!}
        @include('admin/posts/form')
        {!! Form::close() !!}
    </div>


@endsection

@section('scripts')

    <script src="{{ asset('thirdparty/ckeditor-5.11.0.js') }}"></script>
    <script src="{{ asset('scripts/formHelpers.js') }}"></script>
    <script>
        $(function(){
            habb.formHelpers.CkEditorInit(".textarea__tag");
            habb.formHelpers.BackendImageListSelectorInit("{{ action('UploadController@getImagesAsJsonArray') }}");
        });
    </script>
@endsection