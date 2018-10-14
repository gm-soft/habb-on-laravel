
@extends('layouts.auth-layout')
@section('title', 'HABB | Восстановление пароля')

@section('content')

    <div class="container">
        <h1 class="mt-2">Восстановление пароля</h1>

        <form method="POST" action="{{ route('password.email') }}">
            {{ csrf_field() }}

            <div class="form-group {{ $errors->has('email') ? 'has-feedback' : '' }}">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Адрес email">

                @if ($errors->has('email'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span><br>
                @endif
                <small>Введите адрес email, указанный при регистрации</small>
            </div>

            <div class="form-group">
                <div class="float-md-right">
                    <button type="submit" class="btn btn-primary">
                        Послать запрос на восстановление пароля
                    </button>
                </div>

            </div>
        </form>
    </div>
@endsection
