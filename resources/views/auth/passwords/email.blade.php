
@extends('layouts.front-layout')
@section('title', 'Восстановление пароля')

@section('content')

    <div class="uk-container">
        <h1>Восстановление пароля</h1>

        <form method="POST" action="{{ route('password.email') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('email') ? 'uk-form-danger' : '' }}">
                <input id="email" type="email" class="uk-input" name="email" value="{{ old('email') }}" required placeholder="Адрес email">

                @if ($errors->has('email'))
                    <span class="uk-text-danger">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span><br>
                @endif
                <small>Введите адрес email, указанный при регистрации</small>
            </div>

            <div class="form-group">
                <div class="uk-float-right">
                    <button type="submit" class="uk-button uk-button-primary">
                        Послать запрос на восстановление пароля
                    </button>
                </div>

            </div>
        </form>
    </div>
@endsection
