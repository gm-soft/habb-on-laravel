
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

        <div class="">

            @include('front.register.teamRequestRegisterForm')

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
    <script type="text/javascript">

        $(function(){

            habb.formHelpers.setSubmitButtonDisabledAfterSubmit("form");

            $('#modalConfirmButton').on('click', function(){
                $('#inqured').prop('checked', true);
            });

        });
    </script>
@endsection

@section('styles')

@endsection