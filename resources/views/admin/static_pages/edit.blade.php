
@extends('layouts.admin-layout')
@section('title', 'HABB | Редактирование статичной страницы')

@section('content')
    <div class="container mt-3">
        <h1 class="">Редактирование статичной страницы {{ $static_page->unique_name }}</h1>

        <div class="text-muted">
            ID: {{ $static_page->id }}
        </div>

        {!! Form::model($static_page, ['method' => 'PATCH', 'action' => ['StaticPageController@update', $static_page->id], 'class'=> 'form__tag']) !!}


        <div class="row mt-1">
            <div class="col-sm-9">
                <div class="form-group">
                    {{ Form::text('title', old('title'),
                            array('class' => 'form-control', 'required', 'maxlength' => '100', 'placeholder' => 'Введите заголовок страницы')) }}
                    @if ($errors->has('title'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span><br>
                    @endif
                    <small>Максимальное кол-во знаков: 100</small>
                </div>

                <div class="form-group">
                    {{ Form::label('content', 'Контент') }}
                    {{ Form::textarea('content', old('content'),
                            array('class' => 'form-control textarea__tag', 'required', 'maxlength' => '2000',
                            'placeholder' => 'Напечатайте контент страницы. Максимум 2000 знаков', 'id' => 'ckeditor')) }}
                    @if ($errors->has('content'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('content') }}</strong>
                        </span><br>
                    @endif
                    <small>Максимальное кол-во знаков: 2000</small>
                </div>

            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    <button type="submit" id="submit-btn" class="btn btn-primary btn-block mb-1">Сохранить</button>
                    <button type="button" class="btn btn-secondary btn-block mb-1 preview-btn__tag">Предпросмотр</button>
                    <a href="#" class="btn btn-outline-warning btn-block " onclick="window.history.back()">Отменить</a>
                </div>
            </div>

        </div>


        {!! Form::close() !!}
    </div>


@endsection

@section('scripts')

    <script src="//cdn.ckeditor.com/4.10.1/full/ckeditor.js"></script>
    <script src="{{ asset('scripts/formHelpers.js') }}"></script>
    <script>

        CKEDITOR.replace( 'content' );

        $(function(){

            $('.preview-btn__tag').click(function(){
                // предпросмотр страницы
                habb.formHelpers.sendPreviewRequest("{{ action('StaticPageController@preview') }}");
            });
        });
    </script>
@endsection