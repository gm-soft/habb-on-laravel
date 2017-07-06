
@extends('layouts.front-layout')
@section('title', 'Регистрация')

@section('content')

    <div class="container registration-container">
        <h1 class="mt-3 text-md-center">Регистрация</h1>

        <form method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <div class="form-group">

                <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Введите ваше имя" required>

                @if ($errors->has('name'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span><br>
                @endif

                <small>Скажите нам, как Вас зовут</small>
            </div>

            <div class="form-group">
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Введите ваш email" required>

                @if ($errors->has('email'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span><br>
                @endif

                <small>Email будет использоваться как логин</small>
            </div>

            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Введите пароль" required>

                @if ($errors->has('password'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span><br>
                @endif

                <small>Минимальная длина пароля: 6 символов</small>
            </div>

            <div class="form-group has-feedback">
                <input type="password" class="form-control" name="password_confirmation" placeholder="Подтвердите пароль">
                <small>Введите пароль еще раз</small>
            </div>

            <div class="form-group">
                <div class="float-md-right">
                    <button type="submit" class="btn btn-primary">
                        Зарегистрироваться
                    </button>
                    <a href="{{ route('password.request') }}" class="btn btn-link float-md-left">Забыли ваш пароль?</a>
                </div>

            </div>
        </form>
    </div>
@endsection
