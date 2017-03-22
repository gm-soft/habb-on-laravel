
@extends('layouts.front-layout')
@section('title', 'Сбросить пароль')

@section('content')

    <div class="uk-container">
        <h1>Сброс пароля</h1>

        <form method="POST" action="{{ route('password.request') }}">
            {{ csrf_field() }}
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="uk-margin">
                <input id="email" type="email" class="uk-input" name="email"
                       value="{{ $email or old('email') }}" required autofocus placeholder="Адрес email">

                @if ($errors->has('email'))
                    <span class="uk-text-danger">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span><br>
                @endif
                <small>Введите адрес email, указанный при регистрации</small>
            </div>

            <div class="uk-margin">
                <input id="password" type="password" class="uk-input" name="password" required placeholder="Новый пароль">

                @if ($errors->has('password'))
                    <span class="uk-text-danger">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span><br>
                @endif
                <small>Введите новый пароль, который будет использован для доступа</small>
            </div>

            <div class="uk-margin">
                <input id="password-confirm" type="password" class="uk-input" name="password_confirmation" required placeholder="Подтвердите новый пароль">

                @if ($errors->has('password_confirmation'))
                    <span class="uk-text-danger">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span><br>
                @endif
                <small>Введите повторно новый пароль</small>
            </div>

            <div class="uk-margin">
                <div class="uk-float-right">
                    <button type="submit" class="uk-button uk-button-primary">
                        Сбросить пароль
                    </button>
                </div>
            </div>
        </form>

    </div>
@endsection
