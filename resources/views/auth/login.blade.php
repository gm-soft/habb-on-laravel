
@extends('layouts.front-layout')
@section('title', 'Авторизация')


@section('content')

<div class="row auth-block">
    <div class="col-sm-8 offset-sm-2 card">
        <div class="card-block">
            <h1 class="card-title">Авторизация на сайте</h1>
            <div class="card-text">

                @include(\App\Helpers\Constants::ValidationLayout)

                <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <input type="email" class="form-control{{ $errors->has('email') ? ' has-error' : '' }}" id="email" name="email" value="{{ old('email') }}"
                               placeholder="Email адрес" pattern="@EmailFieldPattern()">
                        @if ($errors->has('email'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span><br>
                        @endif
                        <small>Введите адрес email, указанный при регистрации</small>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input type="password" class="form-control" name="password"  placeholder="Пароль">

                        @if ($errors->has('password'))
                            <span class="help-block text-danger">
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

                    <div class="form-group float-sm-right">
                        <button type="submit" class="btn btn-primary">
                            Авторизоваться
                        </button>

                        <a href="{{ route('password.request') }}" class="btn btn-link">Забыли ваш пароль?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
