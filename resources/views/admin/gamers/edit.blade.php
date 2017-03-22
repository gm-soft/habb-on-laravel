
@extends('layouts.admin-layout')
@section('title', 'Редактирование записи')

@section('content')
    <div class="container">
        <h1 class="mt-1">Редактирование записи {{ $gamer->name }}</h1>
        <div class="">

            {!! Form::model($gamer, ['method' => 'put', 'action' => ['GamerController@update', $gamer->id]]) !!}
            @include('admin/gamers/form')
            {!! Form::close() !!}

        </div>
    </div>


@endsection

@section('scripts')
    <script src="{{ asset('thirdparty/select2/select2.min.js') }}"></script>
    <script src="{{ asset('thirdparty/inputmask/jquery.inputmask.bundle.js') }}"></script>
    <script type="text/javascript">
        $(".select2-multiple").select2({
            placeholder: "Иногда играю (можно выбрать несколько)",
        });

        $(".select2-single").select2({
            placeholder: "Играю активно",
        });

        $('#form').submit(function(){
            $("#submit-btn").prop('disabled',true);
        });
        $(document).ready(function(){
            $('#phone').inputmask({"mask": "8(999)999-9999"});

        });
    </script>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('thirdparty/select2/select2.min.css') }}">
@endsection