
@extends('layouts.front-layout')
@section('title', 'Авторизация')


@section('content')

    <div class="uk-container">
        <h1>Авторизация на сайте</h1>

        <form method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            <div class="uk-margin">
                <input type="email" class="uk-input" id="email" name="email" value="{{ old('email') }}"
                       placeholder="Email адрес" pattern="@EmailFieldPattern()">
                @if ($errors->has('email'))
                    <span class="uk-text-danger">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span><br>
                @endif
                <small>Введите адрес email, указанный при регистрации</small>
            </div>

            <div class="uk-margin">
                <input type="password" class="uk-input" name="password"  placeholder="Пароль">

                @if ($errors->has('password'))
                    <span class="uk-text-danger">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span><br>
                @endif
                <small>Введите пароль</small>
            </div>

            <div class="uk-margin">
                <label><input class="uk-checkbox" type="checkbox" {{ old('remember') ? 'checked' : '' }}> Запомнить меня</label>
            </div>

            <div class="uk-margin uk-float-right">
                <button type="submit" class="uk-button uk-button-primary">
                    Авторизоваться
                </button>

                <a href="{{ route('password.request') }}" class="uk-button uk-button-text uk-margin-left">Забыли ваш пароль?</a>
            </div>
        </form>
    </div>
@endsection
