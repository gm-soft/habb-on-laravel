
<div class="row mt-1">
    <div class="col-sm-10">
        <div class="form-group">
            {{ Form::text('key', old('key'),
                    ['class' => 'form-control', 'required', 'maxlength' => '100', 'placeholder' => 'Уникальный ключ']) }}
            @if ($errors->has('key'))
                <span class="help-block text-danger">
            <strong>{{ $errors->first('key') }}</strong>
        </span><br>
            @endif
            <small>Максимальное кол-во знаков: 100</small>
        </div>

        <div class="form-group">
            {{ Form::label('value', 'Значение') }}
            {{ Form::textarea('value', old('value'),
                    ['class' => 'form-control', 'required', 'maxlength' => '1000', 'id' => 'editor']) }}
            @if ($errors->has('value'))
                <span class="help-block text-danger">
            <strong>{{ $errors->first('value') }}</strong>
        </span><br>
            @endif
            <small>Максимальное кол-во знаков: 1000</small>
        </div>


    </div>

    <div class="col-sm-2">
        <div class="form-group">
            <button type="submit" id="submit-btn" class="btn btn-primary mb-1">Сохранить</button>
            <a href="#" class="btn btn-link" onclick="window.history.back()">Отменить</a>
        </div>
    </div>

</div>
