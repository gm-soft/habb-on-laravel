
<div class="row mt-1">
    <div class="col-sm-9">
        <div class="form-group">
            {{ Form::text('title', old('title'),
                    array('class' => 'form-control', 'required', 'maxlength' => '100', 'placeholder' => 'Введите заголовок статьи')) }}
            @if ($errors->has('title'))
                <span class="help-block text-danger">
            <strong>{{ $errors->first('title') }}</strong>
        </span><br>
            @endif
            <small>Максимальное кол-во знаков: 100</small>
        </div>

        <div class="form-group">

            <div class="input-group">
                {{ Form::text('announce_image', old('announce_image'),
                ['class' => 'form-control image_form_control__tag',
                'required',
                'pattern' => \App\Helpers\Constants::AnnounceImagePathRegexPattern,
                'placeholder' => 'Выберите картинку']) }}

                <div class="input-group-append">
                    <button class="btn btn-outline-secondary dropdown-toggle choose_btn__tag" type="button"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">Выбрать картинку</button>

                    <div class="dropdown-menu choose_image_list__tag">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>

            @if ($errors->has('announce_image'))
                <span class="help-block text-danger">
            <strong>{{ $errors->first('announce_image') }}</strong>
        </span><br>
            @endif
        </div>

        <div class="form-group">
            {{ Form::label('content', 'Контент') }}
            {{ Form::textarea('content', old('content'),
                    array('class' => 'form-control textarea__tag', 'required', 'maxlength' => '10000',
                    'placeholder' => 'Напечатайте контент статьи. Максимум 10000 знаков', 'id' => 'ckeditor')) }}
            @if ($errors->has('content'))
                <span class="help-block text-danger">
            <strong>{{ $errors->first('content') }}</strong>
        </span><br>
            @endif
            <small>Максимальное кол-во знаков: 10000</small>
        </div>

    </div>

    <div class="col-sm-3">
        <div class="form-group">
            <button type="submit" id="submit-btn" class="btn btn-primary btn-block mb-1">Опубликовать</button>
            <button type="button" class="btn btn-secondary btn-block mb-1 preview-announce-btn__tag">Предпросмотр анонса</button>
            <button type="button" class="btn btn-secondary btn-block mb-1 preview-btn__tag">Предпросмотр новости</button>
            <a href="#" class="btn btn-outline-warning btn-block " onclick="window.history.back()">Отменить</a>
        </div>
    </div>

</div>
