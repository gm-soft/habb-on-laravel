
@extends('layouts.auth-layout')
@section('title', 'HABB | Сбросить пароль')

@section('content')

    <div class="container">
        <h1 class="mt-2">Сброс пароля</h1>

        <form method="POST" action="{{ route('password.request') }}">
            {{ csrf_field() }}
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <input id="email" type="email" class="form-control" name="email"
                       value="{{ $email or old('email') }}" required autofocus placeholder="Адрес email">

                @if ($errors->has('email'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span><br>
                @endif

                <small>Введите адрес email, указанный при регистрации</small>
            </div>

            <div class="form-group">
                <input id="password" type="password" class="form-control" name="password" required placeholder="Новый пароль">

                @if ($errors->has('password'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span><br>
                @endif
                <small>Введите новый пароль, который будет использован для доступа</small>
            </div>

            <div class="form-group">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Подтвердите новый пароль">

                @if ($errors->has('password_confirmation'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span><br>
                @endif
                <small>Введите повторно новый пароль</small>
            </div>

            <div class="form-group text-md-right">
                <button type="submit" class="btn btn-primary">
                    Сбросить пароль
                </button>
            </div>
        </form>

    </div>
@endsection
