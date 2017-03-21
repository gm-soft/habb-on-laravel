
@extends('layouts.front-layout')
@section('title', 'Регистрация заявки на команду')

@section('content')
    <div class="container">
        <div class="row">
            <div class="form-container">
                <div class="text-sm-center">
                    <h1 class="mt-1">Заявка на создание команды</h1>
                </div>
                {!! Form::open(['action' => ['TeamCreateRequestController@registerTeamFormPost'], 'id' => 'form']) !!}

                    <div class="row">
                        <div class="col-sm-6">
                            <h3>Данные команды</h3>
                            <input type="hidden" name="id" value="{{old('id')}}" >
                            <div class="form-group">
                                {{ Form::label('name', 'Название команды:') }}
                                {{ Form::text('name', old('name'),
                                        array('class' => 'form-control', 'maxlength' => '100', 'placeholder' => 'Введите название команды', 'required' => true)) }}
                                @if ($errors->has('name'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span><br>
                                @endif
                                <small>Придумайте броское название, чтобы оно "врезалось" в память оппонентам</small>
                            </div>

                            <div class="form-group">
                                {{ Form::label('city', 'Город команды') }}
                                {{ Form::select('city', $cities, old('cities'), ['class'=>'form-control', 'required'=>true]) }}
                                <small>Укажите, пожалуйста, город команды</small>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <h3>Обратная связь</h3>
                            <div class="form-group">
                                {{ Form::label('requester_name', 'Имя запросившего') }}
                                {{ Form::text('requester_name', old('requester_name'),
                                        array('class' => 'form-control', 'maxlength' => '100', 'placeholder' => 'Введите свое имя', 'required' => true)) }}
                                @if ($errors->has('comment'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('requester_name') }}</strong>
                                    </span><br>
                                @endif
                                <small>Как нам к Вам обращаться?</small>
                            </div>

                            <div class="form-group">
                                {{ Form::label('requester_phone', 'Телефон запросившего') }}
                                {{ Form::text('requester_phone', old('requester_phone'),
                                        array('class' => 'form-control', 'placeholder' => 'Введите номер телефона', 'required' => true, 'id' => 'phone')) }}
                                @if ($errors->has('requester_phone'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('requester_phone') }}</strong>
                                    </span><br>
                                @endif
                                <small>Номер телефона необходим для связи с Вами в случае возникновения вопросов по поводу заявки</small>
                            </div>

                            <div class="form-group">
                                {{ Form::label('requester_email', 'Email запросившего') }}
                                {{ Form::text('requester_email', old('requester_email'),
                                        array('class' => 'form-control', 'placeholder' => 'Введите свой email', 'pattern' => $emailPattern, 'required' => true)) }}
                                @if ($errors->has('requester_email'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('requester_email') }}</strong>
                                    </span><br>
                                @endif
                                <small>Электронный адрес будет использован для отправки результата рассмотрения заявки</small>
                            </div>
                        </div>

                    </div>

                    <div class="mt-1">
                        <h3>Состав команды</h3>
                        <p>Игрок, указанный первым, будет назначен капитаном</p>
                        @for($i = 0; $i < 5; $i++)

                            @php
                                $placeholder = $i == 0 ? 'Имя капитана' : 'Имя игрока';
                            @endphp
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    {{ Form::number("participant_ids[$i]", old("requester_ids[$i]"),
                                        array('class' => 'form-control', 'placeholder' => 'Habb ID', 'min'=> 0, 'required' => true)) }}
                                </div>
                                <div class="col-sm-9">
                                    {{ Form::text("participant_names[$i]", old("requester_names[$i]"),
                                        array('class' => 'form-control', 'placeholder' => $placeholder, 'required' => true)) }}
                                </div>
                            </div>
                        @endfor


                    </div>

                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="inqured" name="inqured" required> Ознакомлен с <a href="#" data-toggle="modal" data-target="#exampleModalLong">
                                    условиями</a> и даю согласие на обработку моих данных
                            </label>
                        </div>

                    </div>

                    <div class="form-group">
                        <button type="submit" id="submit-btn" class="btn btn-primary btn-block">Отправить</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>




        <!-- Modal -->
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog  modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Согласие на действия с персональными данными</h5>
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
                        <button type="button" id="modalConfirmButton" class="btn btn-primary" data-dismiss="modal">Согласен</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="accountModal" tabindex="-1" role="dialog" aria-labelledby="accountModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="accountModalTitle">Обнаружено совпадение данных</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <!--span aria-hidden="true">&times;</span-->
                        </button>
                    </div>
                    <div id="accountModalBody" class="modal-body">
                        <p>Скорее всего, у Вас уже есть HABB ID. Чтобы его узнать, обратитесь к администрации HABB.KZ <a href="https://vk.com/habbkz">https://vk.com/habbkz</a></p>
                        <p class="text-sm-center">
                            <a href="https://vk.com/habbkz" class=""></a>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <a href="https://vk.com/habbkz" class="btn btn-primary" >Перейти</a>
                        <!--button type="button" class="btn btn-primary" data-dismiss="modal">Перейти</button-->
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