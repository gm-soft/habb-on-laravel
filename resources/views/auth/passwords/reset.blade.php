
@extends('layouts.front-layout')
@section('title', 'Сбросить пароль')

@section('content')

    <div class="row auth-block">
        <div class="col-sm-8 offset-sm-2 card">
            <div class="card-block">
                <h1 class="card-title">Сброс пароля</h1>
                <div class="card-text">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <!-- -->
                        <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input id="email" type="email" class="form-control" name="email"
                                       value="{{ $email or old('email') }}" required autofocus placeholder="Адрес email">

                                @if ($errors->has('email'))
                                    <span class="help-block text-danger">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span><br>
                                @endif
                                <small>Введите адрес email, указанный при регистрации</small>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input id="password" type="password" class="form-control" name="password" required placeholder="Новый пароль">

                                @if ($errors->has('password'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span><br>
                                @endif
                                <small>Введите новый пароль, который будет использован для доступа</small>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Подтвердите новый пароль">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span><br>
                                @endif
                                <small>Введите повторно новый пароль</small>
                            </div>

                            <div class="form-group">
                                <div class="float-sm-right">
                                    <button type="submit" class="btn btn-primary">
                                        Сбросить пароль
                                    </button>
                                </div>
                            </div>
                        </form>

                </div>
            </div>
        </div>
    </div>
@endsection
