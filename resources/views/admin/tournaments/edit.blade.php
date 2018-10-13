
@extends('layouts.admin-layout')
@section('title', 'Редактирование турнира')

@section('content')
    <div class="container mt-2">
        <h1 class="mt-1">Редактирование турнира #{{ $model->tournament->id }}</h1>
        {!! Form::model($model->tournament, ['method' => 'put', 'action' => ['TournamentController@update', $model->tournament->id]]) !!}
            @include('admin.tournaments.form')
        {!! Form::close() !!}
    </div>


@endsection

@section('scripts')
    <script src="{{ asset('scripts/tournamentHelpers.js') }}"></script>
    <script src="{{ asset('thirdparty/select2/js/select2.min.js') }}"></script>
    <script src="//cdn.ckeditor.com/4.10.1/full/ckeditor.js"></script>
    <script type="text/javascript">

        CKEDITOR.replace( 'public_description' );

        $(function(){

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