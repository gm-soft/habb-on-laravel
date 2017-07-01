
@extends('layouts.front-layout')
@section('title', 'Авторизация')


@section('content')

    <div class="container">
        <h1 class="mt-3 text-md-center">Авторизация на сайте</h1>

        <form method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Email адрес" pattern="@EmailFieldPattern()">

                @if ($errors->has('email'))
                    <span class="text-danger">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span><br>
                @endif

                <small>Введите адрес email, указанный при регистрации</small>
            </div>

            <div class="form-group">
                <input type="password" class="form-control" name="password"  placeholder="Пароль">

                @if ($errors->has('password'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span><br>
                @endif

                <small>Введите пароль</small>
            </div>

            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
                    Запомнить меня
                </label>
            </div>

            <div class="form-group text-md-right">
                <a href="{{ route('password.request') }}" class="btn btn-link">Забыли ваш пароль?</a>

                <button type="submit" class="btn btn-primary">
                    Авторизоваться
                </button>
            </div>
        </form>
    </div>
@endsection
