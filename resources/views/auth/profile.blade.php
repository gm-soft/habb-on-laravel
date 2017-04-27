
@extends('layouts.front-layout')
@section('title', 'Habb - Профиль пользователя')

    @php
        /** @var App\User $model */
    @endphp

@section('content')

    <div class="uk-container uk-margin">

        <h1>Профиль {{ $model->name }}</h1>

        <dl class="uk-description-list">
            <dt>Роль</dt>
            <dd>{{ $model->role }}</dd>

            <dt>Email</dt>
            <dd>{{ $model->email }}</dd>
        </dl>

        <hr>
        <div class="uk-margin">
            <a class="uk-button uk-button-text" href="{{ url('password/reset') }}">Сбросить пароль</a>
        </div>

    </div>

@endsection