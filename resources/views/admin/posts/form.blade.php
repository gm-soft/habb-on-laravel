
<div class="form-group">
    {{ Form::label('title', 'Заголовок:') }}
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
            array('class' => 'form-control', 'required', 'maxlength' => '2000', 'placeholder' => 'Напечатайте контент статьи. Максимум 2000 знаков')) }}
    @if ($errors->has('content'))
        <span class="help-block text-danger">
            <strong>{{ $errors->first('content') }}</strong>
        </span><br>
    @endif
    <small>Максимальное кол-во знаков: 2000</small>
</div>

<div class="form-group float-sm-right">
    <button type="submit" id="submit-btn" class="btn btn-primary">Опубликовать</button>
    <a href="#" class="btn btn-link" onclick="window.history.back()">Отменить</a>
</div>