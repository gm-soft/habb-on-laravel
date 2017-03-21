
@extends('layouts.admin-layout')
@section('title', 'Создание записи')

@section('content')
    <div class="container">
        <h1 class="mt-1">Создание заявки на команду</h1>
        {!! Form::open(array('action' => array('TeamCreateRequestController@store'))) !!}
            @include('admin.teamRequests.form')
        {!! Form::close() !!}
    </div>


@endsection

@section('scripts')
    <script src="{{ asset('thirdparty/inputmask/jquery.inputmask.bundle.js') }}"></script>
    <script type="text/javascript">
        $('#form').submit(function(){
            $("#submit-btn").prop('disabled',true);
        });
        $(document).ready(function(){
            $('#phone').inputmask({"mask": "8(999)999-9999"});

        });
    </script>
@endsection

@section('styles')
@endsection