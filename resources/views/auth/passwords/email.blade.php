
@extends('layouts.front-layout')
@section('title', 'Восстановление пароля')

@section('content')

    <div class="row auth-block">
        <div class="card col-sm-8 offset-sm-2">
            <div class="card-block">
                <h1 class="card-title">Восстановление пароля</h1>
                <div class="card-text>">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Адрес email">

                            @if ($errors->has('email'))
                                <span class="help-block text-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span><br>
                            @endif
                            <small>Введите адрес email, указанный при регистрации</small>
                        </div>

                        <div class="form-group">
                            <div class="float-sm-right">
                                <button type="submit" class="btn btn-primary">
                                    Послать запрос на восстановление пароля
                                </button>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
