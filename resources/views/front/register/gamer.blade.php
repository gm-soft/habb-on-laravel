
@extends('layouts.front-layout')
@section('title', 'Регистрация игрока')

@section('content')
    <div class="container">
        <div class="row">
            <div class="form-container">
                <div class="text-sm-center">
                    <h1 class="mt-1">Регистрация участника HABB</h1>
                </div>


                {!! Form::open(['action' => ['GamerController@createGamerAccount'], 'id' => 'form']) !!}

                    <div class="row">
                        <div class="col-sm-6">

                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" id="name" name="name" class="form-control" required placeholder="Имя" maxlength="50" >
                                    <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">

                                    <input type="text" id="last_name" name="last_name" class="form-control" required placeholder="Фамилия" maxlength="50">
                                    <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    @if ($iOsDevice)
                                    <input type="date" class="form-control" id="birthday" name="birthday" required placeholder="Дата рождения">
                                    <span class="input-group-addon">Дата рождения <i class="fa fa-calendar" aria-hidden="true"></i></span>
                                    @else
                                    <input type="text" onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control" id="birthday" name="birthday" required placeholder="Дата рождения">
                                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="input-group">
                                    <select class="form-control" name="city" required>
                                        <option value="" disabled selected>Город</option>
                                        @for($i = 0; $i < count($cities); $i++)
                                            <option value='{{ $cities[$i] }}'>{{ $cities[$i] }}</option>
                                        @endfor
                                    </select>
                                    <span class="input-group-addon"><i class="fa fa-building" aria-hidden="true"></i></span>

                                </div>
                            </div>

                        </div>

                        <div class="col-sm-6">
                            <div id="divPhone" class="form-group">
                                <div class="input-group">
                                    <input type="tel" class="form-control" id="phone" name="phone" required placeholder="Мобильный телефон">
                                    <span class="input-group-addon"><i class="fa fa-mobile" aria-hidden="true"></i></span>
                                </div>
                            </div>

                            <div id="divEmail" class="form-group">
                                <div class="input-group">
                                    <input type="email" class="form-control" id="email" name="email" pattern="@EmailFieldPattern()" required placeholder="yourname@example.com" maxlength="50">
                                    <span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                </div>
                            </div>

                            <div class="form-group ">
                                <div class="input-group">

                                    <input type="text" class="form-control" id="vk_page" name="vk_page" pattern="@VkFieldPattern()" required placeholder="https://vk.com/" maxlength="40">
                                    <span class="input-group-addon"><i class="fa fa-vk" aria-hidden="true"></i></span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <h4 class="text-sm-center">Статус</h4>
                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <select class="form-control" name="status" required>
                                        <option value="" disabled selected>Статус</option>
                                        <option value="student">Студент</option>
                                        <option value="pupil">Школьник</option>
                                        <option value="employee">Работаю</option>
                                        <option value="dumbass">В активном поиске себя</option>
                                    </select>
                                    <span class="input-group-addon"><i class="fa fa-users" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group ">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="institution" name="institution" placeholder="Название учреждения" required maxlength="50">
                                    <span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="text-sm-center">
                        <h4>Я играю</h4>
                    </div>

                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <select class="form-control select2 select2-single" name="primary_game" required>
                                        <option value="" selected disabled>Играю активно</option>
                                        <option value="dota">Dota</option>
                                        <option value="cs:go">CS:GO</option>
                                        <option value="lol">League of Legends</option>
                                        <option value="hearthstone">Hearthstone</option>
                                        <option value="wot">World of Tanks</option>
                                        <option value="overwatch">Overwatch</option>
                                        <option value="cod">Call of Duty (серия игр)</option>
                                    </select>
                                    <span class="input-group-addon"><i class="fa fa-gamepad" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <select class="form-control select2 select2-multiple" name="secondary_games[]" required multiple="multiple" >
                                        <option value="dota">Dota</option>
                                        <option value="cs:go">CS:GO</option>
                                        <option value="lol">League of Legends</option>
                                        <option value="hearthstone">Hearthstone</option>
                                        <option value="wot">World of Tanks</option>
                                        <option value="overwatch">Overwatch</option>
                                        <option value="cod">Call of Duty (серия игр)</option>
                                    </select>
                                    <span class="input-group-addon"><i class="fa fa-gamepad" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="form-group">
                        <div class="checkbox">
                            <label><input type="checkbox" id="inqured" name="inqured" required> Ознакомлен с <a href="#" data-toggle="modal" data-target="#exampleModalLong">условиями</a> и даю согласие на обработку моих данных</label>
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
    <script src="{{ asset('js/select2.js') }}"></script>
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
        /*$(document).ready(function(){
            $(selector).inputmask("99-9999999");  //static mask
            $(selector).inputmask({"mask": "8(999)999-9999"}); //specifying options
            $(selector).inputmask("8-a{1,3}9{1,3}"); //mask with dynamic syntax
        });*/
    </script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection