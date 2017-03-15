
@extends('layouts.admin-layout')
@section('title', 'Создание записи')

@section('content')
    <div class="container">
        <h1 class="mt-1">Создание заявки на команду</h1>
        {!! Form::open(array('action' => array('TeamCreateRequestController@store'))) !!}
            @include('admin/teamRequests/form')
        {!! Form::close() !!}
    </div>


@endsection

@section('scripts')
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script type="text/javascript">

        $(".select2-single").select2({
            placeholder: "Выберите игрока",
        });

        $('#form').submit(function(){
            $("#submit-btn").prop('disabled',true);
        });
    </script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection