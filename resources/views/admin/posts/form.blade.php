
<div class="row mt-1">
    <div class="col-sm-10">
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
            {{ Form::label('content', 'Контент') }}
            {{ Form::textarea('content', old('content'),
                    array('class' => 'form-control', 'required', 'maxlength' => '10000',
                    'placeholder' => 'Напечатайте контент статьи. Максимум 10000 знаков', 'id' => 'ckeditor')) }}
            @if ($errors->has('content'))
                <span class="help-block text-danger">
            <strong>{{ $errors->first('content') }}</strong>
        </span><br>
            @endif
            <small>Максимальное кол-во знаков: 10000</small>
        </div>


    </div>

    <div class="col-sm-2">
        <div class="form-group">
            <button type="submit" id="submit-btn" class="btn btn-primary mb-1">Опубликовать</button>
            <a href="#" class="btn btn-link" onclick="window.history.back()">Отменить</a>
        </div>
    </div>

</div>
