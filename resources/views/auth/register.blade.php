
@extends('layouts.front-layout')
@section('title', 'Регистрация')

@section('content')

    <div class="row auth-block">
        <div class="col-sm-8 offset-sm-2 card">
            <div class="card-block">
                <h1 class="card-title">Регристрация</h1>
                <div class="card-text">

                    @include(\App\Helpers\Constants::ValidationLayout)

                    <form class="" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <input type="text" class="form-control{{ $errors->has('name') ? ' has-error' : '' }}"
                                   name="name" value="{{ old('name') }}" placeholder="Введите ваше имя" required>
                            @if ($errors->has('name'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span><br>
                            @endif
                            <small>Скажите нам, как Вас зовут</small>
                        </div>

                        <div class="form-group">
                            <input type="email" class="form-control{{ $errors->has('email') ? ' has-error' : '' }}" name="email" value="{{ old('email') }}"
                                   placeholder="Введите ваш email" required>
                            @if ($errors->has('email'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span><br>
                            @endif
                            <small>Email будет использоваться как логин</small>
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control{{ $errors->has('password') ? ' has-error' : '' }}" name="password"
                                   placeholder="Введите пароль" required>

                            @if ($errors->has('password'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span><br>
                            @endif
                            <small>Минимальная длина пароля: 6 символов</small>
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" name="password_confirmation"
                                   placeholder="Подтвердите пароль">
                            <small>Введите пароль еще раз</small>
                        </div>

                        <div class="form-group">
                            <div class="float-sm-right">
                                <button type="submit" class="btn btn-primary">
                                    Зарегистрироваться
                                </button>
                                <a href="{{ route('password.request') }}" class="btn btn-link">Забыли ваш пароль?</a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
