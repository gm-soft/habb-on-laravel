
@extends('layouts.admin-layout')
@section('title', 'Редактирование записи')
@php
    /** @var \App\User $user */
    $displayPasswords = false;
@endphp
@section('content')
    <div class="container">
        <h1 class="mt-1">Редактирование записи {{ $user->email }}</h1>
        <div class="mt-3">

            {!! Form::model($user, ['method' => 'put', 'action' => ['UserController@update', $user->id]]) !!}
                @include('admin/users/form')
            {!! Form::close() !!}

        </div>
    </div>


@endsection
