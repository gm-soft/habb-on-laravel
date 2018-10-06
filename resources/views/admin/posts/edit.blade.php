
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

@section('scripts')
    <script src="https://cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>

    <script>
        CKEDITOR.replace('content');
    </script>

    <script src="{{ asset('scripts/formHelpers.js') }}"></script>
    <script>
        $(function(){
            habb.formHelpers.BackendImageListSelectorInit("{{ action('UploadController@getImagesAsJsonArray') }}");
        });
    </script>
@endsection