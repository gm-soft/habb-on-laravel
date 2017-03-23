
@extends('layouts.front-layout')
@section('title', 'Регистрация')

@section('content')

    <div class="uk-container">
        <h1>Регристрация</h1>

        <form method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <div class="uk-margin">
                <input type="text" class="uk-input"
                       name="name" value="{{ old('name') }}" placeholder="Введите ваше имя" required>
                @if ($errors->has('name'))
                    <span class="uk-text-danger">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span><br>
                @endif
                <small>Скажите нам, как Вас зовут</small>
            </div>

            <div class="uk-margin">
                <input type="email" class="uk-input" name="email" value="{{ old('email') }}"
                       placeholder="Введите ваш email" required>
                @if ($errors->has('email'))
                    <span class="uk-text-danger">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span><br>
                @endif
                <small>Email будет использоваться как логин</small>
            </div>

            <div class="uk-margin">
                <input type="password" class="uk-input" name="password"
                       placeholder="Введите пароль" required>

                @if ($errors->has('password'))
                    <span class="uk-text-danger">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span><br>
                @endif
                <small>Минимальная длина пароля: 6 символов</small>
            </div>

            <div class="uk-margin">
                <input type="password" class="uk-input" name="password_confirmation" placeholder="Подтвердите пароль">
                <small>Введите пароль еще раз</small>
            </div>

            <div class="uk-margin">
                <div class="uk-float-right">
                    <button type="submit" class="uk-button uk-button-primary">
                        Зарегистрироваться
                    </button>
                    <a href="{{ route('password.request') }}" class="uk-button uk-button-text uk-margin-left">Забыли ваш пароль?</a>
                </div>

            </div>
        </form>
    </div>
@endsection
