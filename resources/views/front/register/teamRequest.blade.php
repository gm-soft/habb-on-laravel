
@extends('layouts.front-layout')
@section('title', 'HABB | Участвовать в турнире')

@php

    $formName = isset($model->tournamentName) ? "Участвовать в турнире ".$model->tournamentName : "Участвовать в турнире";
@endphp

@section('content')
    <div class="container mt-2">

        <div class="my-3 text-center">
            <h1>{{ $formName }}</h1>
        </div>

        <div class="my-3">
            Для участия в турнире всем участникам команды нужен HABB ID.
            Для того, чтобы его получить, можете перейти к
            <a href="{{ action('GamerController@registerForm', ['from' => 'team_registration']) }}" target="_blank">форме регистрации</a>
        </div>

        {!! Form::open(['action' => ['RegisterFormController@saveTeamRegisterForTournament'], 'id' => 'form']) !!}

        <div class="row">

            <div class="col-md-6">
                <h3>Команда</h3>

                <input type="hidden" name="t" value="{{$model->tournamentId}}" >

                <div class="form-group {{ $errors->has('name') ? "has-danger" : "" }}">
                    {{ Form::label('name', 'Название команды:')}}
                    {{ Form::text('name', old('name'),
                            array('class' => 'form-control', 'maxlength' => '100', 'placeholder' => 'Введите название команды', 'required' => true)) }}

                    @if ($errors->has('name'))
                        <span class="form-control-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span><br>
                    @endif

                    <small>Придумайте броское название, чтобы оно "врезалось" в память оппонентам</small>
                </div>

                <div class="form-group">
                    {{ Form::label('city', 'Город команды')}}
                    {{ Form::select('city', $model->cities, old('cities'), ['class'=>'form-control', 'required'=>true]) }}
                    <small>Укажите, пожалуйста, город команды</small>
                </div>
            </div>

            <div class="col-md-6">

                <h3>Участники</h3>

                <div class="form-group">
                    <small>Заполните в поля ниже HABB ID участников команды. Разрешены только цифры. Обязательные поля помечены знаком <b>*</b></small>
                </div>

                <div class="form-group row {{ $errors->has(\App\Models\Team::Captain_ForeignColumn) ? "has-danger" : "" }}">
                    <div class="col-sm-4 text-nowrap">
                        {{ Form::label(\App\Models\Team::Captain_ForeignColumn, 'Капитан *') }}
                    </div>
                    <div class="col-sm-8">
                        {{ Form::input('tel', \App\Models\Team::Captain_ForeignColumn, old(\App\Models\Team::Captain_ForeignColumn),
                        ['class' => 'form-control',
                         'maxlength' => '10',
                         'placeholder' => 'HABB ID капитана',
                         'required' => true,
                         'pattern' => \App\Helpers\Constants::DigitsOnlyRegexPattern]) }}

                        @if ($errors->has(\App\Models\Team::Captain_ForeignColumn))
                            <span class="form-control-feedback">
                            <strong>{{ $errors->first(\App\Models\Team::Captain_ForeignColumn) }}</strong>
                        </span><br>
                        @endif
                    </div>


                </div>

                <div class="form-group row {{ $errors->has(\App\Models\Team::SecondGamer_ForeignColumn) ? "has-danger" : "" }}">
                    <div class="col-sm-4 text-nowrap">
                        {{ Form::label(\App\Models\Team::SecondGamer_ForeignColumn, 'Второй игрок: *') }}
                    </div>
                    <div class="col-sm-8">
                        {{ Form::input('tel', \App\Models\Team::SecondGamer_ForeignColumn, old(\App\Models\Team::SecondGamer_ForeignColumn),
                        ['class' => 'form-control',
                         'maxlength' => '10',
                         'placeholder' => 'HABB ID второго игрока',
                         'required' => true,
                         'pattern' => \App\Helpers\Constants::DigitsOnlyRegexPattern]) }}

                        @if ($errors->has(\App\Models\Team::SecondGamer_ForeignColumn))
                            <span class="form-control-feedback">
                            <strong>{{ $errors->first(\App\Models\Team::SecondGamer_ForeignColumn) }}</strong>
                        </span><br>
                        @endif
                    </div>


                </div>

                <div class="form-group row {{ $errors->has(\App\Models\Team::ThirdGamer_ForeignColumn) ? "has-danger" : "" }}">
                    <div class="col-sm-4 text-nowrap">
                        {{ Form::label(\App\Models\Team::ThirdGamer_ForeignColumn, 'Третий игрок: *') }}
                    </div>
                    <div class="col-sm-8">
                        {{ Form::input('tel', \App\Models\Team::ThirdGamer_ForeignColumn, old('third_gamer_habb_id'),
                        ['class' => 'form-control',
                         'maxlength' => '10',
                         'placeholder' => 'HABB ID третьего игрока',
                         'required' => true,
                         'pattern' => \App\Helpers\Constants::DigitsOnlyRegexPattern]) }}

                        @if ($errors->has(\App\Models\Team::ThirdGamer_ForeignColumn))
                            <span class="form-control-feedback">
                            <strong>{{ $errors->first(\App\Models\Team::ThirdGamer_ForeignColumn) }}</strong>
                        </span><br>
                        @endif
                    </div>


                </div>

                <div class="form-group row {{ $errors->has(\App\Models\Team::ForthGamer_ForeignColumn) ? "has-danger" : "" }}">
                    <div class="col-sm-4 text-nowrap">
                        {{ Form::label(\App\Models\Team::ForthGamer_ForeignColumn, 'Четвертый игрок: *') }}
                    </div>
                    <div class="col-sm-8">

                        {{ Form::input('tel', \App\Models\Team::ForthGamer_ForeignColumn, old(\App\Models\Team::ForthGamer_ForeignColumn),
                            ['class' => 'form-control',
                             'maxlength' => '10',
                             'placeholder' => 'HABB ID четвертого игрока',
                             'required' => true,
                             'pattern' => \App\Helpers\Constants::DigitsOnlyRegexPattern]) }}

                        @if ($errors->has(\App\Models\Team::ForthGamer_ForeignColumn))
                            <span class="form-control-feedback">
                            <strong>{{ $errors->first(\App\Models\Team::ForthGamer_ForeignColumn) }}</strong>
                        </span><br>
                        @endif
                    </div>

                </div>

                <div class="form-group row {{ $errors->has(\App\Models\Team::FifthGamer_ForeignColumn) ? "has-danger" : "" }}">
                    <div class="col-sm-4 text-nowrap">
                        {{ Form::label(\App\Models\Team::FifthGamer_ForeignColumn, 'Пятый игрок: *') }}
                    </div>
                    <div class="col-sm-8">
                        {{ Form::input('tel', \App\Models\Team::FifthGamer_ForeignColumn, old(\App\Models\Team::FifthGamer_ForeignColumn),
                        ['class' => 'form-control',
                         'maxlength' => '10',
                         'placeholder' => 'HABB ID пятого игрока',
                         'required' => true,
                         'pattern' => \App\Helpers\Constants::DigitsOnlyRegexPattern]) }}

                        @if ($errors->has(\App\Models\Team::FifthGamer_ForeignColumn))
                            <span class="form-control-feedback">
                            <strong>{{ $errors->first(\App\Models\Team::FifthGamer_ForeignColumn) }}</strong>
                        </span><br>
                        @endif
                    </div>


                </div>

                <div class="form-group row {{ $errors->has(\App\Models\Team::OptionalGamer_ForeignColumn) ? "has-danger" : "" }}">
                    <div class="col-sm-4 text-nowrap">
                        {{ Form::label(\App\Models\Team::OptionalGamer_ForeignColumn, 'Запасной игрок:') }}
                    </div>
                    <div class="col-sm-8">
                        {{ Form::input('tel', \App\Models\Team::OptionalGamer_ForeignColumn, old(\App\Models\Team::OptionalGamer_ForeignColumn),
                        ['class' => 'form-control',
                         'maxlength' => '10',
                         'placeholder' => 'HABB ID запосного игрока',
                         'pattern' => \App\Helpers\Constants::DigitsOnlyRegexPattern]) }}

                        @if ($errors->has(\App\Models\Team::OptionalGamer_ForeignColumn))
                            <span class="form-control-feedback">
                            <strong>{{ $errors->first(\App\Models\Team::OptionalGamer_ForeignColumn) }}</strong>
                        </span><br>
                        @endif
                        <small>Если нет запасного игрока, то можете не заполнять поле</small>
                    </div>


                </div>

            </div>

        </div>

        <div class="form-group form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="inqured" name="inqured" required>
                Ознакомлен с <a href="#" data-toggle="modal" data-target="#resolution">условиями</a> и даю согласие на обработку моих данных
            </label>
        </div>

        <div class="form-group">
            <button type="submit" id="submit-btn" class="btn btn-primary btn-lg btn-block">Отправить заявку</button>
        </div>
    {!! Form::close() !!}




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
    <script src="{{ asset('thirdparty/inputmask/jquery.inputmask.bundle.js') }}"></script>
    <script type="text/javascript">

        $('#form').submit(function(){
            $("#submit-btn").prop('disabled',true);
        });

        $(document).ready(function(){
            $('#modalConfirmButton').on('click', function(){
                $('#inqured').prop('checked', true);
            });
            $('#phone').inputmask({"mask": "8(999)999-9999"});

        });
    </script>
@endsection

@section('styles')

@endsection