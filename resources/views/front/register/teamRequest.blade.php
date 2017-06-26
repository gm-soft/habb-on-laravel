
@extends('layouts.front-layout')
@section('title', 'Регистрация заявки на команду')

@section('content')
    <div class="container mt-2">
        
        <div class="my-2 text-center">
            <h1>Заявка на создание команды</h1>
        </div>

        {!! Form::open(['action' => ['TeamCreateRequestController@registerTeamFormPost'], 'id' => 'form']) !!}

        <div class="uk-grid" uk-grid>
            <div class="uk-width-1-2">
                <h3>Данные команды</h3>
                <input type="hidden" name="id" value="{{old('id')}}" >

                <div class="uk-margin">
                    {{ Form::label('name', 'Название команды:'), ['class'=> 'uk-form-label'] }}
                    {{ Form::text('name', old('name'),
                            array('class' => 'uk-input', 'maxlength' => '100', 'placeholder' => 'Введите название команды', 'required' => true)) }}
                    @if ($errors->has('name'))
                        <span class="uk-text-danger">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span><br>
                    @endif
                    <small>Придумайте броское название, чтобы оно "врезалось" в память оппонентам</small>
                </div>

                <div class="uk-margin">
                    {{ Form::label('city', 'Город команды') , ['class'=> 'uk-form-label']}}
                    {{ Form::select('city', $cities, old('cities'), ['class'=>'uk-select', 'required'=>true]) }}
                    <small>Укажите, пожалуйста, город команды</small>
                </div>
            </div>

            <div class="uk-width-1-2">
                <h3>Обратная связь</h3>
                <div class="uk-margin">
                    {{ Form::label('requester_name', 'Имя запросившего', ['class'=> 'uk-form-label']) }}
                    {{ Form::text('requester_name', old('requester_name'),
                            array('class' => 'uk-input', 'maxlength' => '100', 'placeholder' => 'Введите свое имя', 'required' => true)) }}
                    @if ($errors->has('requester_name'))
                        <span class="uk-text-danger">
                            <strong>{{ $errors->first('requester_name') }}</strong>
                        </span><br>
                    @endif
                    <small>Как нам к Вам обращаться?</small>
                </div>

                <div class="uk-margin">
                    {{ Form::label('requester_phone', 'Телефон запросившего'), ['class'=> 'uk-form-label'] }}
                    {{ Form::text('requester_phone', old('requester_phone'),
                            array('class' => 'uk-input', 'placeholder' => 'Введите номер телефона', 'required' => true, 'id' => 'phone')) }}
                    @if ($errors->has('requester_phone'))
                        <span class="uk-text-danger">
                            <strong>{{ $errors->first('requester_phone') }}</strong>
                        </span><br>
                    @endif
                    <small>Номер телефона необходим для связи с Вами в случае возникновения вопросов по поводу заявки</small>
                </div>

                <div class="uk-margin">
                    {{ Form::label('requester_email', 'Email запросившего'), ['class'=> 'uk-form-label'] }}
                    {{ Form::text('requester_email', old('requester_email'),
                            array('class' => 'uk-input', 'placeholder' => 'Введите свой email', 'pattern' => $emailPattern, 'required' => true)) }}
                    @if ($errors->has('requester_email'))
                        <span class="uk-text-danger">
                            <strong>{{ $errors->first('requester_email') }}</strong>
                        </span><br>
                    @endif
                    <small>Электронный адрес будет использован для отправки результата рассмотрения заявки</small>
                </div>
            </div>

        </div>

        <div class="uk-margin">
            <h3>Состав команды</h3>
            <p>Игрок, указанный первым, будет назначен капитаном</p>
            @for($i = 0; $i < 5; $i++)

                @php
                    $placeholder = $i == 0 ? 'Имя капитана' : 'Имя игрока';
                @endphp
                <div class="uk-margin" uk-grid>
                    <div class="uk-width-1-4">
                        {{ Form::number("participant_ids[$i]", old("requester_ids[$i]"),
                            array('class' => 'uk-input', 'placeholder' => 'Habb ID', 'min'=> 0, 'required' => true)) }}
                    </div>
                    <div class="uk-width-3-4">
                        {{ Form::text("participant_names[$i]", old("requester_names[$i]"),
                            array('class' => 'uk-input', 'placeholder' => $placeholder, 'required' => true)) }}
                    </div>
                </div>
            @endfor


        </div>

        <div class="uk-margin">
            <label>
                <input type="checkbox" class="uk-checkbox" id="inqured" name="inqured" required>
                Ознакомлен с <a href="#resolution" uk-toggle>условиями</a> и даю согласие на обработку моих данных
            </label>
        </div>

        <div class="uk-margin">
            <button type="submit" id="submit-btn" class="uk-button uk-button-primary">Отправить</button>
        </div>
    {!! Form::close() !!}




        <!-- Modal -->
        <div id="resolution" uk-modal >
            <div class="uk-modal-dialog">
                <button class="uk-modal-close-default" type="button" uk-close></button>
                <div class="uk-modal-header">
                    <h2 class="uk-modal-title">Согласие на действия с персональными данными</h2>
                </div>

                <div class="uk-modal-body" uk-overflow-auto>
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

                <div class="uk-modal-footer uk-text-right">
                    <button type="button" id="modalConfirmButton" class="uk-button uk-button-primary  uk-modal-close" data-dismiss="modal">Согласен</button>
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