
@extends('layouts.admin-layout')
@section('title', 'Редактирование турнира')

@section('content')
    <div class="container">
        <h1 class="mt-1">Редактирование турнира {{ $instance->name }}</h1>
        {!! Form::model($instance, ['method' => 'put', 'action' => ['TournamentController@update', $instance->id]]) !!}
            @include('admin.tournaments.form')
        {!! Form::close() !!}
    </div>


@endsection

@section('scripts')
    <script src="{{ asset('custom/tournamentHelper.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script type="text/javascript">

        $(".select2-single").select2({
            placeholder: "Выберите участников",
        });
        tournamentHelper.registerListeners();

        $('#form').submit(function(){
            $("#submit-btn").prop('disabled',true);
        });
    </script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection