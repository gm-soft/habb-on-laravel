
@extends('layouts.front-layout')
@section('title', 'HABB | - Профиль пользователя')

    @php
        /** @var App\User $model */
    @endphp

@section('content')

    <div class="container mt-5">

        <h1 class="mt-2">Профиль {{ $model->current_user->name }}</h1>

        <dl class="">
            <dt>Роль</dt>
            <dd>{{ $model->current_user->role }}</dd>

            <dt>Email</dt>
            <dd>{{ $model->current_user->email }}</dd>
        </dl>

        <hr>
        <div class="mt-2">
            <a class="btn btn-link" href="{{ url('password/reset') }}">Сбросить пароль</a>
        </div>

    </div>

@endsection