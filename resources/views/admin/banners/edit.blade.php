
@extends('layouts.admin-layout')
@section('title', 'HABB | Редактирование баннера')

@section('content')
    <div class="container mt-2">

        <h1 class="mt-1">Редактирование баннера #{{ $banner->id }}</h1>

        {!! Form::model($banner, ['method' => 'put', 'action' => ['BannerController@update', $banner->id]]) !!}
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