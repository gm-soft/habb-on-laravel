
<input type="hidden" name="id" value="{{old('id')}}">

<div class="form-group row">
    {{ Form::label('title', 'Название:', ['class' => 'col-sm-3 col-form-label']) }}
    <div class="col-sm-9">
        {{ Form::text('title', old('title'), array('class' => 'form-control', 'required', 'maxlength' => '100', 'placeholder' => 'Введите название сервиса')) }}

        @if ($errors->has('title'))
            <span class="help-block text-danger">
                <strong>{{ $errors->first('title') }}</strong>
            </span><br>
        @endif
    </div>
</div>

<div class="form-group row">
    {{ Form::label('comment', 'Комментарий', ['class' => 'col-sm-3 col-form-label']) }}
    <div class="col-sm-9">
        {{ Form::textarea('comment', old('comment'),
            array('class' => 'form-control', 'maxlength' => '250', 'placeholder' => 'Максимум 250 символов')) }}
        @if ($errors->has('comment'))
            <span class="help-block text-danger">
                <strong>{{ $errors->first('comment') }}</strong>
            </span><br>
        @endif
    </div>
</div>


<div class="form-group mt-2">
    <button type="submit" id="submit-btn" class="btn btn-primary">Сохранить</button>
</div>