
<div class="row">
    <div class="col-sm-8">

        <input type="hidden" name="id" value="{{old('id')}}" >

        <div class="form-group">
            {{ Form::label('title', 'Заголовок') }}
            {{ Form::text('title', old('title'), array('class' => 'form-control', 'maxlength' => '100', 'placeholder' => 'Введите заголовок баннера')) }}

            @if ($errors->has('title'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('title') }}</strong>
                </span><br>
            @endif
        </div>

        <div class="form-group">
            {{ Form::label('subtitle', 'Подзаголовок') }}
            {{ Form::text('subtitle', old('subtitle'), array('class' => 'form-control', 'maxlength' => '100', 'placeholder' => 'Введите подзаголовок')) }}

            @if ($errors->has('subtitle'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('subtitle') }}</strong>
                </span><br>
            @endif
        </div>

        <div class="form-group">

            <div class="input-group">
                {{ Form::text('image_path', old('image_path'),
                ['class' => 'form-control image_form_control__tag',
                'required',
                'pattern' => \App\Helpers\Constants::AnnounceImagePathRegexPattern,
                'placeholder' => 'Выберите картинку']) }}

                <div class="input-group-append">
                    <button class="btn btn-outline-secondary dropdown-toggle choose_btn__tag" type="button"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">Выбрать картинку</button>

                    <div class="dropdown-menu choose_image_list__tag"></div>
                </div>
            </div>

            @if ($errors->has('image_path'))
                <span class="help-block text-danger"><strong>{{ $errors->first('image_path') }}</strong></span><br>
            @endif
        </div>

        <div class="form-group">
            {{ Form::label('attached_to_main_page', 'Прикреплено ли к главной странице') }}
            {{ Form::checkbox('attached_to_main_page', old('attached_to_main_page'), old('attached_to_main_page')) }}

            @if ($errors->has('attached_to_main_page'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('attached_to_main_page') }}</strong>
                </span><br>
            @endif
        </div>

    </div>

    <div class="col-sm-4">

        <div class="form-group">
            <label for="select2-multiple__tag">Выберите турниры, где будет висеть баннер</label>
            <select id="select2-multiple__tag" class="select2-multiple__tag w-100" name="tournaments[]" multiple="multiple">

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