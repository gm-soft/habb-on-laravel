
@extends('layouts.front-layout')
@section('title', 'HABB | Участвовать в турнире')

@php
    $formName = "Записаться гостем на ивент ".$model->tournamentName;
@endphp

@section('content')
    <div class="container mt-2">

        <div class="my-3 text-center">
            <h1>{{ $formName }}</h1>
        </div>

        <div class="mt-3">
            Регистрация на ивент в качестве гостя обязательна для того, чтобы мы могли подарить фишки и лотерейки :)
            Для записи не нужен HABB ID, но если вы хотите стать частью нашего сообщества, то можете перейти к
            <a href="{{ action('GamerController@registerForm', ['from' => 'team_registration']) }}" target="_blank">форме регистрации</a>,
            получить HABB ID и вернуться сюда.

        </div>

        <div class="mt-3">

            {!! Form::open(['action' => ['RegisterFormController@saveTeamRegisterForTournament'], 'id' => 'form']) !!}

            <input type="hidden" name="t" value="{{$model->tournamentId}}" >

            <div class="">
                <div class="text-center h3">
                    У вас есть HABB ID?
                </div>

                <div class="mt-2 row">

                    <div class="col-md-6 p-3">
                        <button type="button" class="btn btn-lg btn-primary btn-block btn-yes__habb-id__tag"
                                data-toggle="collapse"
                                data-target="#block__has-habb-id__tag"
                                aria-expanded="false"
                                aria-controls="block__has-habb-id__tag">Да</button>
                    </div>

                    <div class="col-md-6 p-3">
                        <button type="button" class="btn btn-lg btn-primary btn-block btn-no__habb-id__tag"
                                data-toggle="collapse"
                                data-target="#block__no-habb-id__tag"
                                aria-expanded="false"
                                aria-controls="block__no-habb-id__tag">Нет</button>
                    </div>

                </div>

            </div>

            <div class="collapse block__has-habb-id__tag" id="block__has-habb-id__tag">

                <div class="card">
                    <div class="card-body">
                        <div class="card-text">
                            <div class="form-group {{ $errors->has('habb_id') ? "has-danger" : "" }}">

                                {{ Form::label('habb_id', 'Ваш HABB ID')}}
                                {{ Form::tel('habb_id', old('habb_id'),
                                    ['class' => 'form-control has-habb_input__tag', 'maxlength' => '100', 'placeholder' => 'Введите HABB ID']) }}

                                @if ($errors->has('habb_id'))
                                <span class="form-control-feedback">
                                    <strong>{{ $errors->first('habb_id') }}</strong>
                                </span><br>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <div class="collapse block__no-habb-id__tag" id="block__no-habb-id__tag">

                <div class="card">
                    <div class="card-body">
                        <div class="card-text">
                            <div class="form-group {{ $errors->has('name') ? "has-danger" : "" }}">
                                {{ Form::label('name', 'Имя')}}
                                {{ Form::text('name', old('name'),
                                        array('class' => 'form-control no-habb_input__tag', 'maxlength' => '100', 'placeholder' => 'Введите имя')) }}
                                @if ($errors->has('name'))
                                    <span class="form-control-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span><br>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('last_name') ? "has-danger" : "" }}">
                                {{ Form::label('last_name', 'Фамилия')}}
                                {{ Form::text('last_name', old('last_name'),
                                        array('class' => 'form-control no-habb_input__tag', 'maxlength' => '100', 'placeholder' => 'Введите фамилию')) }}
                                @if ($errors->has('last_name'))
                                    <span class="form-control-feedback">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </span><br>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('phone') ? "has-danger" : "" }}">
                                <div class="text-nowrap">
                                    {{ Form::label('phone', 'Мобильный телефон для связи') }}
                                </div>
                                {{ Form::input('tel', 'phone', old('phone'),
                                    ['class' => 'form-control no-habb_input__tag',
                                     'id' => 'phone',
                                     'maxlength' => '14',
                                     'placeholder' => 'Мобильный телефон']) }}

                                @if ($errors->has('phone'))
                                <span class="form-control-feedback">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span><br>
                                @endif
                                <small>Номер телефона необходим, чтобы мы могли связаться с вами в случае возникновения каких-то вопросов</small>
                            </div>

                            <div class="form-group">

                                @if ($model->isIosDevice)

                                    <label for="birthday">Дата рождения</label>
                                    <input type="date" class="form-control no-habb_input__tag" id="birthday" name="birthday" required placeholder="Дата рождения">

                                @else
                                    <input type="text" class="form-control habb_input-birthday__tag no-habb_input__tag" name="birthday" placeholder="Дата рождения">

                                @endif

                                @if ($errors->has('birthday'))
                                    <br><div class="help-block text-danger">
                                        <strong>{{ $errors->first('birthday') }}</strong>
                                    </div><br>
                                @endif
                            </div>

                            <div class="form-group habb_form-group-email__tag">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                    </div>
                                    <input type="email" class="form-control habb_input-email__tag no-habb_input__tag"
                                           name="email" pattern="@EmailFieldPattern()" placeholder="yourname@example.com" maxlength="100">
                                    @if ($errors->has('email'))
                                        <br><div class="help-block text-danger">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </div><br>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>


            <div class="mt-2 form-group form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" id="inqured" name="inqured" required>
                    Ознакомлен с <a href="#" data-toggle="modal" data-target="#resolution">условиями</a> и даю согласие на обработку моих данных
                </label>
            </div>

            <div class="form-group">
                <button type="submit" id="submit-btn" class="btn btn-info btn-lg btn-block" disabled>Отправить заявку</button>
            </div>
            {!! Form::close() !!}

        </div>


        <!-- Modal -->
        <div class="modal fade" id="resolution" tabindex="-1" role="dialog" aria-labelledby="resolution" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Согласие на действия с персональными данными</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>
                            Я принимаю решение о предоставлении моих персональных данных и даю согласие на действия с моими персональными данными свободно, своей волей и в своем интересе.
                        </p>

                        <p>
                            Наименование и e-mail адрес, получающего согласие субъекта персональных данных: «Киберспортивная Организация HABB»,
                            со следующей целью сбора и обработки персональных данных: рассылка сообщений на e-mail.
                        </p>

                        <p>
                            Перечень персональных данных, на сбор и обработку которых дается согласие субъекта персональных данных:
                            фамилия, имя; дата рождения; номер контактного телефона; электронный адрес; Steam аккаунт; ссылка на профиль ВК; пол; статус; предпочитаемые дисциплины.
                            Перечень действий с персональными данными, на совершение которых дается согласие: сбор, систематизация,
                            накопление, хранение, уточнение (обновление, изменение, дополнение), использование, распространение, передача, обезличивание, блокирование,
                            уничтожение персональных данных.
                        </p>

                        <p>
                            Срок, в течение которого действует согласие субъекта персональных данных,
                            если иное не установлено законодательством РК составляет – 5 лет с
                            даты предоставления персональных данных. На основании письменного обращения
                            субъекта персональных данных с требованием о прекращении обработки его персональных данных оператор прекратит
                            обработку таких персональных данных в течение 24 (двадцати четырех) часов. В порядке предусмотренном действующим
                            законодательством Республики Казахстан, согласие может быть отозвано субъектом персональных данных путем письменного
                            обращения к оператору, получающему согласие субъекта персональных данных.
                        </p>

                        <p>
                            Я согласен (на) с тем, что по моему письменному требованию все уведомления о персональных данных
                            будут вручаться мне (моему представителю) по месту нахождения подразделения.
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button id="modalConfirmButton" class="btn btn-primary" data-dismiss="modal">Согласен</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')

    <script src="{{ asset('scripts/formHelpers.js') }}"></script>
    <script src="{{ asset('thirdparty/inputmask/jquery.inputmask.bundle.js') }}"></script>
    <script type="text/javascript">

        $(function(){

            habb.formHelpers.setSubmitButtonDisabledAfterSubmit("form");

            $('#phone').inputmask({"mask": "8(999)999-9999"});

            $('#modalConfirmButton').on('click', function(){
                $('#inqured').prop('checked', true);
            });

            var block__hasHabbId = $("#block__has-habb-id__tag");
            var block__noHabbId = $("#block__no-habb-id__tag");
            var submitBtn = $("#submit-btn");

            var hasHabbBlockInputs = $(".has-habb_input__tag");
            var noHabbBlockInputs = $(".no-habb_input__tag");

            $(".btn-yes__habb-id__tag").click(function(){

                submitBtn.removeAttr("disabled");

                hasHabbBlockInputs.attr("required", "true");
                noHabbBlockInputs.removeAttr("required");

                if (block__noHabbId.hasClass("show"))
                    block__noHabbId.collapse("hide");
            });

            $(".btn-no__habb-id__tag").click(function(){

                submitBtn.removeAttr("disabled");

                noHabbBlockInputs.attr("required", "true");
                hasHabbBlockInputs.removeAttr("required");

                if (block__hasHabbId.hasClass("show"))
                    block__hasHabbId.collapse("hide");
            });

            block__hasHabbId.on("hidden.bs.collapse", function(){
                if (!block__noHabbId.hasClass("show"))
                    submitBtn.attr("disabled", "true");
            });

            block__noHabbId.on("hidden.bs.collapse", function(){
                if (!block__hasHabbId.hasClass("show"))
                    submitBtn.attr("disabled", "true");
            });

        });
    </script>
@endsection

@section('styles')

@endsection