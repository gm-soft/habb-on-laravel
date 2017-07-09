
@extends('layouts.admin-layout')
@section('title', 'Создание записи')

@php
    $displayPasswords = true;
@endphp

@section('content')
    <div class="container">
        <h1 class="mt-1">Создание записи</h1>
        <div class="">
            {!! Form::open(array('action' => array('UserController@store'))) !!}
                @include('admin/users/form')
            {!! Form::close() !!}
        </div>
    </div>


@endsection