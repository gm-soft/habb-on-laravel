
@extends('layouts.front-layout')
@section('title', 'Регистрация игрока')

@section('content')
    <div class="container mt-2 registration-container">
        <div class="my-3">
            <h1 class="text-center ">Регистрация участника HABB</h1>
        </div>


        {!! Form::open(['action' => ['GamerController@createGamerAccount'], 'class' => 'habb_form__tag']) !!}

        <div class="mt-1">

            <div class="form-group">
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                    <input type="text" id="name" name="name" class="form-control" required placeholder="Имя" maxlength="50" >
                    @if ($errors->has('name'))
                        <div class="help-block text-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </div><br>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                    <input type="text" id="last_name" name="last_name" class="form-control" required placeholder="Фамилия" maxlength="50">
                    @if ($errors->has('last_name'))
                        <div class="help-block text-danger">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </div><br>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <input type="text" class="form-control habb_input-birthday__tag"
                       name="birthday" placeholder="Дата рождения" required>
                @if ($errors->has('birthday'))
                    <div class="help-block text-danger">
                            <strong>{{ $errors->first('birthday') }}</strong>
                        </div><br>
                @endif
            </div>


            <div class="form-group">
                <select class="form-control" name="city" required title="Выберите город">
                    <option value="" disabled selected>Город</option>
                    @for($i = 0; $i < count($cities); $i++)
                        <option value='{{ $cities[$i] }}'>{{ $cities[$i] }}</option>
                    @endfor
                </select>
            </div>

            <div class="form-group habb_form-group-phone__tag">
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-mobile" aria-hidden="true"></i>
                        </span>
                    <input type="tel" class="form-control habb_input-phone__tag" name="phone" required placeholder="Мобильный телефон">
                    @if ($errors->has('phone'))
                        <div class="help-block text-danger">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </div><br>
                    @endif
                </div>
            </div>

            <div class="form-group habb_form-group-email__tag">
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    <input type="email" class="form-control habb_input-email__tag"
                           name="email" pattern="@EmailFieldPattern()" required placeholder="yourname@example.com" maxlength="100">
                    @if ($errors->has('email'))
                        <div class="help-block text-danger">
                            <strong>{{ $errors->first('email') }}</strong>
                        </div><br>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-vk" aria-hidden="true"></i>
                        </span>
                    <input type="text" class="form-control habb_input-vk__tag" name="vk_page"
                           pattern="@VkFieldPattern()" required placeholder="https://vk.com/" maxlength="50">
                    @if ($errors->has('vk_page'))
                        <div class="help-block text-danger">
                            <strong>{{ $errors->first('vk_page') }}</strong>
                        </div><br>
                    @endif
                </div>
            </div>
        </div>




        <div class="row">

            <div class="col-md-6">

                <h3 class="text-center">Статус</h3>

                <div class="form-group">
                    <select class="form-control" name="status" required title="Выберите свой статус">
                        <option value="" disabled selected>Статус</option>
                        <option value="student">Студент</option>
                        <option value="pupil">Школьник</option>
                        <option value="employee">Работаю</option>
                        <option value="dumbass">В активном поиске себя</option>
                    </select>
                </div>
                @if ($errors->has('status'))
                    <div class="help-block text-danger">
                            <strong>{{ $errors->first('status') }}</strong>
                        </div><br>
                @endif

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" id="institution" name="institution" placeholder="Название учреждения" required maxlength="50">
                        @if ($errors->has('institution'))
                            <div class="help-block text-danger">
                            <strong>{{ $errors->first('institution') }}</strong>
                        </div><br>
                        @endif
                    </div>
                </div>

            </div>

            <div class="col-md-6">

                <h3 class="text-center">Я играю ...</h3>

                <div class="form-group">
                    <select class="form-control select2 select2-single" name="primary_game" required title="Выберите свою основную дисциплину">
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
                @if ($errors->has('primary_game'))
                    <div class="help-block text-danger">
                            <strong>{{ $errors->first('primary_game') }}</strong>
                        </div><br>
                @endif
                <div class="form-group">
                    <select class="form-control select2 select2-multiple" name="secondary_games[]" required multiple="multiple" title="Выберите доп. дисциплины">
                        <option value="dota">Dota</option>
                        <option value="cs:go">CS:GO</option>
                        <option value="lol">League of Legends</option>
                        <option value="hearthstone">Hearthstone</option>
                        <option value="wot">World of Tanks</option>
                        <option value="overwatch">Overwatch</option>
                        <option value="cod">Call of Duty (серия игр)</option>
                    </select>
                </div>
                @if ($errors->has('secondary_games'))
                    <div class="help-block text-danger">
                            <strong>{{ $errors->first('secondary_games') }}</strong>
                        </div><br>
                @endif

            </div>

        </div>

        <div class="form-group form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input habb_form-check-input__tag" name="inqured" required>
                Ознакомлен с <a href="#" data-toggle="modal" data-target="#resolution">условиями</a> и даю согласие на обработку моих данных
            </label>
        </div>

        <div class="form-group">
            <button type="submit" id="submit-btn" class="btn btn-primary btn-block">Отправить</button>
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
                        <button type="button" class="btn btn-primary habb_modal-confirm-btn__tag" data-dismiss="modal">Согласен</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade habb_account_modal__tag" id="accountModal" tabindex="-1" role="dialog" aria-labelledby="accountModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Обнаружено совпадение данных</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>
                            Скорее всего, у Вас уже есть HABB ID.
                            Чтобы его узнать, обратитесь к администрации HABB.KZ <a href="https://vk.com/habbkz">https://vk.com/habbkz</a>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <a href="https://vk.com/habbkz" class="btn btn-primary" data-dismiss="modal">Перейти</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('thirdparty/select2/select2.js') }}"></script>
    <script src="{{ asset('thirdparty/inputmask/jquery.inputmask.bundle.js') }}"></script>
    <script src="{{ asset('scripts/registrationHelpers.js') }}"></script>
    <script type="text/javascript">

        $(function(){
            habb.registrationHelpers.RegisterListeners();
        });
    </script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('thirdparty/select2/select2.min.css') }}">
@endsection