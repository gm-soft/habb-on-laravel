
@extends('layouts.admin-layout')
@section('title', 'Редактирование команды')

@section('content')
    <div class="container">
        <h1 class="mt-1">Редактирование заявки на команду {{ $instance->name }}</h1>
        {!! Form::model($instance, ['method' => 'put', 'action' => ['TeamCreateRequestController@update', $instance->id]]) !!}
        @include('admin/teamRequests/form')
        {!! Form::close() !!}
    </div>


@endsection

@section('scripts')
    <script type="text/javascript">

        $('#form').submit(function(){
            $("#submit-btn").prop('disabled',true);
        });
    </script>
@endsection

@section('styles')
@endsection