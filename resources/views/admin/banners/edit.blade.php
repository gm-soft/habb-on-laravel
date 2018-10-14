
@extends('layouts.admin-layout')
@section('title', 'HABB | Редактирование баннера')

@section('content')
    <div class="container mt-2">

        <h1 class="mt-1">Редактирование баннера #{{ $model->banner->id }}</h1>

        {!! Form::model($model->banner, ['method' => 'put', 'action' => ['BannerController@update', $model->banner->id]]) !!}
            @include('admin.banners.form')
        {!! Form::close() !!}
    </div>


@endsection

@section('scripts')
    <script src="{{ asset('thirdparty/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('scripts/formHelpers.js') }}"></script>
    <script type="text/javascript">

        $(function(){

            habb.formHelpers.BackendImageListSelectorInit("{{ action('UploadController@getImagesAsJsonArray') }}");

            $(".select2-multiple__tag").select2();

            $('#form').submit(function(){
                $("#submit-btn").prop('disabled',true);
            });
        });
    </script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('thirdparty/select2/css/select2.min.css') }}">
@endsection