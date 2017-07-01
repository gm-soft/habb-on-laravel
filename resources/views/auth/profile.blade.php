
@extends('layouts.front-layout')
@section('title', 'Habb - Профиль пользователя')

    @php
        /** @var App\User $model */
    @endphp

@section('content')

    <div class="container">

        <h1 class="mt-2">Профиль {{ $model->name }}</h1>

        <dl class="">
            <dt>Роль</dt>
            <dd>{{ $model->role }}</dd>

            <dt>Email</dt>
            <dd>{{ $model->email }}</dd>
        </dl>

        <hr>
        <div class="mt-2">
            <a class="btn btn-link" href="{{ url('password/reset') }}">Сбросить пароль</a>
        </div>

    </div>

@endsection