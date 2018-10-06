
@extends('layouts.admin-layout')
@section('title', 'Создание поста')

@section('content')
    <div class="container">
        <h1 class="mt-1">Новая статья</h1>
        {!! Form::open(['action' => ['PostController@store'], 'class'=> 'form__tag']) !!}
        @include('admin/posts/form')
        {!! Form::close() !!}
    </div>


@endsection

@section('scripts')

    <script src="//cdn.ckeditor.com/4.10.1/full/ckeditor.js"></script>
    <script src="{{ asset('scripts/formHelpers.js') }}"></script>
    <script>

        CKEDITOR.replace( 'content' );

        $(function(){

            habb.formHelpers.BackendImageListSelectorInit("{{ action('UploadController@getImagesAsJsonArray') }}");

            $('.preview-announce-btn__tag').click(function(){
                // предпросмотр анонса новости
                habb.formHelpers.sendPreviewRequest("{{ action('PostController@postAnnouncePreview') }}");
            });

            $('.preview-btn__tag').click(function(){
                // предпросмотр новости
                habb.formHelpers.sendPreviewRequest("{{ action('PostController@postPreview') }}");
            });
        });
    </script>
@endsection