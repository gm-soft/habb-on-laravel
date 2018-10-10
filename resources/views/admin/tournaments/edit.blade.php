
@extends('layouts.admin-layout')
@section('title', 'Редактирование турнира')

@section('content')
    <div class="container mt-2">
        <h1 class="mt-1">Редактирование турнира #{{ $instance->id }}</h1>
        {!! Form::model($instance, ['method' => 'put', 'action' => ['TournamentController@update', $instance->id]]) !!}
            @include('admin.tournaments.form')
        {!! Form::close() !!}
    </div>


@endsection

@section('scripts')
    <script src="{{ asset('scripts/tournamentHelpers.js') }}"></script>
    <script src="{{ asset('thirdparty/select2/select2.min.js') }}"></script>
    <script type="text/javascript">

        $(function(){
            $('#form').submit(function(){
                $("#submit-btn").prop('disabled',true);
            });
        });
    </script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('thirdparty/select2/select2.min.css') }}">
@endsection