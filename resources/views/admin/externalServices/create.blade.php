@extends('layouts.admin-layout')
@section('title', 'Создание записи о внешнем сервисе')

@section('content')
    <div class="container">
        <h1 class="mt-1">Создание записи о внешнем сервисе</h1>
        <div class="">
            {!! Form::open(array('action' => array('ExternalServicesController@store'))) !!}
            @include('admin/externalServices/form')
            {!! Form::close() !!}
        </div>
    </div>

@endsection