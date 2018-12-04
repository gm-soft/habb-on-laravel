
@extends('layouts.front-layout')
@section('title', 'HABB | Участвовать в ивенте')

@php
    $formName = "Записаться гостем на ивент ".$model->tournamentName;
@endphp

@section('content')
    <div class="container mt-2">

        <div class="my-3 text-center">
            <h1>{{ $formName }}</h1>
        </div>

        <div class="mt-3">
            <div class="card border-info">
                <div class="card-body">
                    <div class="card-text text-info">
                        Регистрация на ивент в качестве гостя обязательна для того, чтобы мы могли подарить фишки и лотерейки :)
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-3">

            {!! Form::open(['action' => ['RegisterFormController@saveGuestForTournamentForm'], 'id' => 'form']) !!}

            <input type="hidden" name="tournamentId" value="{{$model->tournamentId}}" >
            <input type="hidden" name="shared_by_habb_id" value="{{$model->sharedByHabbId}}" >

            <div class="form-group {{ $errors->has('name') ? "has-danger" : "" }}">
                {{ Form::label('name', 'Имя')}}
                {{ Form::text('name', old('name'),
                        array('class' => 'form-control', 'maxlength' => '100', 'placeholder' => 'Введите имя', 'required' => true)) }}
                @if ($errors->has('name'))
                    <div class="form-control-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </div>
                @endif

            </div>

            <div class="form-group {{ $errors->has('last_name') ? "has-danger" : "" }}">
                {{ Form::label('last_name', 'Фамилия')}}
                {{ Form::text('last_name', old('last_name'),
                        array('class' => 'form-control', 'maxlength' => '100',
                        'placeholder' => 'Введите фамилию', 'required' => true)) }}
                @if ($errors->has('last_name'))
                    <div class="form-control-feedback">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </div>
                @endif
            </div>

            <div class="form-group {{ $errors->has('phone') ? "has-danger" : "" }}">
                <div class="text-nowrap">
                    {{ Form::label('phone', 'Мобильный телефон для связи') }}
                </div>
                {{ Form::input('phone', old('phone'),
                    ['class' => 'form-control',
                     'id' => 'phone',
                     'maxlength' => '14',
                     'required' => true,
                     'placeholder' => 'Мобильный телефон']) }}

                @if ($errors->has('phone'))
                    <div class="form-control-feedback">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </div>
                @endif
                <small>Номер телефона необходим, чтобы мы могли связаться с вами в случае возникновения каких-то вопросов</small>
            </div>

            <div class="form-group">

                @if ($model->isIosDevice)

                    <label for="birthday">Дата рождения</label>
                    <input type="date" class="form-control" id="birthday" name="birthday" placeholder="Дата рождения" required>

                @else
                    <input type="text" class="form-control habb_input-birthday__tag" name="birthday" placeholder="Дата рождения" required>

                @endif

                @if ($errors->has('birthday'))
                    <div class="help-block text-danger">
                        <strong>{{ $errors->first('birthday') }}</strong>
                    </div>
                @endif
            </div>

            <div class="form-group habb_form-group-email__tag">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                    </div>
                    <input type="email" class="form-control habb_input-email__tag"
                           name="email" pattern="@EmailFieldPattern()" placeholder="yourname@example.com" maxlength="100" required>
                    @if ($errors->has('email'))
                        <div class="help-block text-danger">
                            <strong>{{ $errors->first('email') }}</strong>
                        </div>
                    @endif
                </div>
            </div>


            <div class="mt-2 form-group form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" id="inqured" name="inqured" required>
                    Ознакомлен с <a href="#" data-toggle="modal" data-target="#resolution">условиями</a> и даю согласие на обработку моих данных
                </label>
            </div>

            <div class="form-group">
                <button type="submit" id="submit-btn" class="btn btn-info btn-lg btn-block">Отправить заявку</button>
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
    <script src="{{ asset('scripts/registrationHelpers.js') }}"></script>
    <script type="text/javascript">

        $(function(){

            habb.formHelpers.setSubmitButtonDisabledAfterSubmit("form");

            $('#phone').inputmask({"mask": "8(999)999-9999"});

            $('#modalConfirmButton').on('click', function(){
                $('#inqured').prop('checked', true);
            });

            habb.registrationHelpers.setDateInputTypeChange('habb_input-birthday__tag');

        });
    </script>
@endsection

@section('styles')

@endsection