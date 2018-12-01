@extends('layouts.front-layout')
@section('title', 'HABB | Регистрация на ивент')

@section('content')

    <div class="container">

        <div class="jumbotron">
            <div class="">
                <h1 class="display-2 d-none d-lg-block d-xl-block">
                    Вы успешно зарегистрировались на ивент <strong>"{{ $model->tournament->name }}"</strong>
                </h1>

                <h1 class="display-3 d-none d-md-block d-lg-none d-xl-none">
                    Вы успешно зарегистрировались на ивент <strong>"{{ $model->tournament->name }}"</strong>
                </h1>

                <h2 class="d-xs-block d-sm-block d-md-none d-lg-none d-xl-none">
                    Вы успешно зарегистрировались на ивент <strong>"{{ $model->tournament->name }}"</strong>
                </h2>

            </div>

            <hr>
            <div class="lead">
                <div class="h4">Будем ждать вас с друзьями :)</div>
                <div>
                    Если хочешь получить много лотерейных билетов для большого розыгрыша, то поделись этой ссылкой с друзьями
                </div>
            </div>
            <div class="mt-3">

                <div class="text-center d-none d-md-block d-lg-block d-xl-block">
                    <a href="#" class="btn btn-link copy-btn__tag"
                       data-toggle="tooltip" data-placement="bottom"
                       title="Копировать ссылку"
                       data-original-title="Копировать ссылку">
                        <span class="h4">{{ $model->linkToShare }}</span>
                    </a>
                </div>

                <div class="d-xs-block d-sm-block d-md-none d-lg-none d-xl-none">
                    <div>{{ $model->linkToShare }}</div>

                    <button class="btn btn-primary btn-block copy-btn__tag" type="button"
                            data-toggle="tooltip" data-placement="bottom"
                            title="Копировать ссылку"
                            data-original-title="Копировать ссылку">
                        <i class="fa fa-copy"></i> Копировать ссылку
                    </button>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <a href="{{ action('HomeController@index') }}" class="btn btn-outline-primary btn-lg btn-block">На главную страницу</a>
        </div>

    </div>

@endsection

@section('scripts')

    <script>
        $(function () {

            $('[data-toggle="tooltip"]').tooltip();

            $('.copy-btn__tag').on('click', function () {

                habb.utils.CopyToClipboard("{{ $model->linkToShare }}");

                var self = $(this);
                self
                    .tooltip('dispose')
                    .attr('title', 'Скопировано!')
                    .tooltip('show');

                self.attr('title', 'Копировать ссылку');
                self.attr('data-original-title', 'Копировать ссылку');
            });
        })
    </script>
@endsection