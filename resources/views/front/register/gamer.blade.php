
@extends('layouts.front-layout')
@section('title', 'Регистрация игрока')

@section('content')
    <div class="uk-container">
        <div class="form-container">
            <div class="uk-text-center">
                <h1 class="uk-margin">Регистрация участника HABB</h1>
            </div>


            {!! Form::open(['action' => ['GamerController@createGamerAccount'], 'id' => 'form']) !!}

            <div uk-grid>
                <div class="uk-width-1-2">

                    <div class="uk-margin">
                        <div class="uk-inline uk-width-1-1">
                            <span class="uk-form-icon"><i class="fa fa-user" aria-hidden="true"></i></span>
                            <input type="text" id="name" name="name" class="uk-input" required placeholder="Имя" maxlength="50" >

                        </div>
                    </div>

                    <div class="uk-margin">
                        <div class="uk-inline uk-width-1-1">
                            <span class="uk-form-icon"><i class="fa fa-user" aria-hidden="true"></i></span>
                            <input type="text" id="last_name" name="last_name" class="uk-input" required placeholder="Фамилия" maxlength="50">
                        </div>
                    </div>

                    <div class="uk-margin">
                        <div class="uk-inline uk-width-1-1">
                            @if ($iOsDevice)
                                <span class="uk-form-icon">Дата рождения <i class="fa fa-calendar" aria-hidden="true"></i></span>
                                <input type="date" class="uk-input" id="birthday" name="birthday" required placeholder="Дата рождения">

                            @else
                                <span class="uk-form-icon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                <input type="text" onfocus="(this.type='date')" onblur="(this.type='text')" class="uk-input" id="birthday" name="birthday" required placeholder="Дата рождения">

                            @endif
                        </div>
                    </div>


                    <div class="uk-margin">
                        <select class="uk-select" name="city" required title="ВЫберите город">
                            <option value="" disabled selected>Город</option>
                            @for($i = 0; $i < count($cities); $i++)
                                <option value='{{ $cities[$i] }}'>{{ $cities[$i] }}</option>
                            @endfor
                        </select>
                    </div>

                </div>

                <div class="uk-width-1-2">
                    <div id="divPhone" class="uk-margin">
                        <div class="uk-inline uk-width-1-1">
                            <span class="uk-form-icon"><i class="fa fa-mobile" aria-hidden="true"></i></span>
                            <input type="tel" class="uk-input" id="phone" name="phone" required placeholder="Мобильный телефон">

                        </div>
                    </div>

                    <div id="divEmail" class="uk-margin">
                        <div class="uk-inline uk-width-1-1">
                            <span class="uk-form-icon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                            <input type="email" class="uk-input" id="email" name="email" pattern="@EmailFieldPattern()" required placeholder="yourname@example.com" maxlength="60">

                        </div>
                    </div>

                    <div class="uk-margin">
                        <div class="uk-inline uk-width-1-1">
                            <span class="uk-form-icon"><i class="fa fa-vk" aria-hidden="true"></i></span>
                            <input type="text" class="uk-input" id="vk_page" name="vk_page" pattern="@VkFieldPattern()" required placeholder="https://vk.com/" maxlength="40">
                        </div>
                    </div>

                </div>
            </div>



            <h3 class="uk-text-center">Статус</h3>
            <div class="uk-grid" uk-grid>

                <div class="uk-width-1-2">
                    <div class="uk-margin uk-width-1-1">
                        <select class="uk-select" name="status" required title="Выберите свой статус">
                            <option value="" disabled selected>Статус</option>
                            <option value="student">Студент</option>
                            <option value="pupil">Школьник</option>
                            <option value="employee">Работаю</option>
                            <option value="dumbass">В активном поиске себя</option>
                        </select>
                    </div>
                </div>

                <div class="uk-width-1-2">
                    <div class="uk-margin">
                        <div class="uk-inline uk-width-1-1">
                            <span class="uk-form-icon"><i class="fa fa-university" aria-hidden="true"></i></span>
                            <input type="text" class="uk-input" id="institution" name="institution" placeholder="Название учреждения" required maxlength="50">

                        </div>
                    </div>
                </div>

            </div>

            <div class="uk-text-center">
                <h3>Я играю</h3>
            </div>

            <div class="uk-grid" uk-grid>

                <div class="uk-width-1-2">
                    <div class="uk-margin">
                        <select class="uk-select select2 select2-single" name="primary_game" required title="Выберите свою основную дисциплину">
                            <option value="" selected disabled>Играю активно</option>
                            <option value="dota">Dota</option>
                            <option value="cs:go">CS:GO</option>
                            <option value="lol">League of Legends</option>
                            <option value="hearthstone">Hearthstone</option>
                            <option value="wot">World of Tanks</option>
                            <option value="overwatch">Overwatch</option>
                            <option value="cod">Call of Duty (серия игр)</option>
                        </select>
                    </div>
                </div>


                <div class="uk-width-1-2">
                    <div class="uk-margin">
                        <select class="uk-select select2 select2-multiple" name="secondary_games[]" required multiple="multiple" title="Выберите доп. дисциплины">
                            <option value="dota">Dota</option>
                            <option value="cs:go">CS:GO</option>
                            <option value="lol">League of Legends</option>
                            <option value="hearthstone">Hearthstone</option>
                            <option value="wot">World of Tanks</option>
                            <option value="overwatch">Overwatch</option>
                            <option value="cod">Call of Duty (серия игр)</option>
                        </select>
                    </div>
                </div>


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
        </div>




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

        <div id="accountModal" uk-modal="center: true">
            <div class="uk-modal-dialog">
                <button class="uk-modal-close-default" type="button" uk-close></button>
                <div class="uk-modal-header">
                    <h2 class="uk-modal-title">Обнаружено совпадение данных</h2>
                </div>
                <div class="uk-modal-body">
                    <p>
                        Скорее всего, у Вас уже есть HABB ID.
                        Чтобы его узнать, обратитесь к администрации HABB.KZ <a href="https://vk.com/habbkz">https://vk.com/habbkz</a>
                    </p>
                </div>
                <div class="uk-modal-footer uk-text-right">
                    <a href="https://vk.com/habbkz" class="uk-button uk-button-primary">Перейти</a>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="{{ asset('thirdparty/select2/select2.js') }}"></script>
    <script src="{{ asset('thirdparty/inputmask/jquery.inputmask.bundle.js') }}"></script>
    <script type="text/javascript">

        $('.select2').select2();
        $(".select2-multiple").select2({
            placeholder: "Иногда играю (можно выбрать несколько)",
        });

        $(".select2-single").select2({
            placeholder: "Играю активно",
        });

        $('#form').submit(function(){
            $("#submit-btn").prop('disabled',true);
        });

        $(document).ready(function(){
            registrationHelpers.RegisterListeners();
            $('#phone').inputmask({"mask": "8(999)999-9999"});

        });
    </script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('thirdparty/select2/select2.min.css') }}">
@endsection