
<div class="row">
    <div class="col-sm-8">
        <input type="hidden" name="id" value="{{old('id')}}" >

        <div class="form-group">
            {{ Form::label('name', 'Название') }}
            {{ Form::text('name', old('name'),
                    array('class' => 'form-control', 'required'=> true, 'maxlength' => '100', 'placeholder' => 'Введите название турнира')) }}
            @if ($errors->has('name'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('name') }}</strong>
                </span><br>
            @endif
        </div>

        <div class="form-group">
            {{ Form::label('public_description', 'Публичное описание турнира') }}
            {{ Form::textarea('public_description', old('public_description'),
                    array('class' => 'form-control', 'maxlength' => '500', 'placeholder' => 'Максимум 500 символов', 'required'=>true)) }}
            @if ($errors->has('public_description'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('public_description') }}</strong>
                </span><br>
            @endif
        </div>

    </div>

    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('started_at', 'Время начала турнира') }}
            {{ Form::date('started_at', isset($instance) ? $instance->getStartedAt() : null,
                    array('class' => 'form-control', 'required'=> true)) }}
            @if ($errors->has('started_at'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('started_at') }}</strong>
                </span><br>
            @endif
        </div>

        <div class="form-group">
            {{ Form::label('reg_closed_at', 'Время закрытия регистрации на турнир') }}
            {{ Form::date('reg_closed_at', isset($instance) ? $instance->getRegClosedAt() : null,
                    array('class' => 'form-control', 'required'=> true)) }}
            @if ($errors->has('reg_closed_at'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('reg_closed_at') }}</strong>
                </span><br>
            @endif
        </div>

        <div class="form-group">
            {{ Form::label('comment', 'Комментарий') }}
            {{ Form::textarea('comment', old('comment'),
                    array('class' => 'form-control', 'maxlength' => '250', 'placeholder' => 'Максимум 250 символов')) }}
            @if ($errors->has('comment'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('comment') }}</strong>
                </span><br>
            @endif
        </div>
    </div>

</div>

<div class="form-group">
    <button type="submit" id="submit-btn" class="btn btn-primary btn-block">Сохранить</button>
</div>