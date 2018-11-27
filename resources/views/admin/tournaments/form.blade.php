
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
            {{ Form::text('hashtags', old('hashtags'),
                    array('class' => 'form-control', 'maxlength' => \App\Helpers\Constants::HashTagFieldMaxLength, 'placeholder' => 'Введите хэштеги через запятую')) }}
            @if ($errors->has('hashtags'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('hashtags') }}</strong>
                </span><br>
            @endif
            <small>
                Введите хэштеги через запятую с пробелом. Примеры: <i>первый_хэштег, турнир_dota2</i>
                <br>
                Максимальное кол-во знаков: {{ \App\Helpers\Constants::HashTagFieldMaxLength }}
            </small>
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

            {{ Form::label('event_date', 'Когда будет проведен турнир') }}
            {{ Form::datetimeLocal('event_date', isset($model->tournament) ? $model->tournament->event_date : null,
                    array('class' => 'form-control', 'required'=> true)) }}
            @if ($errors->has('event_date'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('event_date') }}</strong>
                </span><br>
            @endif

        </div>

        <div class="form-group">

            {{ Form::label('registration_deadline', 'Когда будет закрыта регистрация команд) }}
            {{ Form::datetimeLocal('registration_deadline', isset($model->tournament) ? $model->tournament->registration_deadline : null,
                    array('class' => 'form-control', 'required'=> true)) }}
            @if ($errors->has('registration_deadline'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('registration_deadline') }}</strong>
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

        <div class="card">
            <div class="card-body">

                <div class="form-group">
                    <button type="submit" id="submit-btn" class="btn btn-primary btn-block">Сохранить</button>
                    <button type="button" class="btn btn-secondary btn-block mb-1 preview-btn__tag">Предпросмотр</button>
                    <a href="#" class="btn btn-outline-warning btn-block " onclick="window.history.back()">Отменить</a>
                </div>

            </div>

        </div>
    </div>

</div>

