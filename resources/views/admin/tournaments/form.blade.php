
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

        <div class="form-group">
            {{ Form::label('event_date', 'Время начала турнира') }}
            {{ Form::date('event_date', isset($model->tournament) ? $model->tournament->getEventDate() : null,
                    array('class' => 'form-control', 'required'=> true)) }}
            @if ($errors->has('event_date'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('event_date') }}</strong>
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

    <div class="col-sm-4">

        <div class="form-group">
            {{ Form::label('attached_to_nav', 'Прикреплен ли к панели навигации') }}
            {{ Form::checkbox('attached_to_nav', old('attached_to_nav'), old('attached_to_nav')) }}

            @if ($errors->has('attached_to_nav'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('attached_to_nav') }}</strong>
                </span><br>
            @endif
        </div>

        <div class="form-group">
            <label for="select2-multiple__tag">Баннеры, которые будут отображены в шапке турнира</label>
            <select id="select2-multiple__tag" class="select2-multiple__tag w-100" name="banners[]" multiple="multiple">

                @foreach ($model->select_options as $select_option)

                    @php
                        $selected = $select_option->is_selected ? "selected=\"selected\"" : "";
                    @endphp

                    <option value="{{ $select_option->id }}" {{ $selected }}>{{ $select_option->title }}</option>
                @endforeach
            </select>
        </div>
    </div>

</div>

<div class="form-group">
    <button type="submit" id="submit-btn" class="btn btn-primary btn-block">Сохранить</button>
</div>