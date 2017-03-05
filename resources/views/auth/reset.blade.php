@extends(\App\Helpers\Constants::FrontLayoutPath)

@section('content')

    <div class="card">
        <div class="card-block">
            <h1 class="card-title">Сбросить пароль</h1>
            <div class="card-text">

                @include(\App\Helpers\Constants::ValidationLayout)

                <form class="form-horizontal" role="form" method="POST" action="/password/reset">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group">
                        <label class="col-md-4 control-label">E-Mail адрес</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Пароль</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Подтвердите пароль</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Сбросить пароль
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection