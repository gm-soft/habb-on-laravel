
@extends('layouts.admin-layout')
@section('title', 'HABB | Создание баннера')

@section('content')
    <div class="container mt-2">

        <h1 class="mt-1">Создание баннера</h1>

        {!! Form::open(array('action' => array('BannerController@store'))) !!}
            @include('admin.banners.form')
        {!! Form::close() !!}
    </div>


@endsection

@section('scripts')

    <script src="{{ asset('thirdparty/select2/select2.min.js') }}"></script>
    <script src="{{ asset('scripts/formHelpers.js') }}"></script>
    <script type="text/javascript">

        $(function(){

            habb.formHelpers.BackendImageListSelectorInit("{{ action('UploadController@getImagesAsJsonArray') }}");

            $('#form').submit(function(){
                $("#submit-btn").prop('disabled',true);
            });
        });
    </script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('thirdparty/select2/select2.min.css') }}">
@endsection