
<div class="row">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-block">
                <p class="card-text">

                <input type="hidden" name="id" value="{{old('id')}}" >



                <div class="form-group row">
                    {{ Form::label('name', 'Имя:', ['class' => 'col-sm-3 col-form-label']) }}
                    <div class="col-sm-9">
                        {{ Form::text('name', old('name'),
                            array('class' => 'form-control', 'required', 'maxlength' => '50', 'placeholder' => 'Введите имя')) }}
                        @if ($errors->has('name'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span><br>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    {{ Form::label('name', 'Фамилия', ['class' => 'col-sm-3 col-form-label']) }}
                    <div class="col-sm-9">
                        {{ Form::text('last_name', old('last_name'),
                            array('class' => 'form-control', 'required', 'maxlength' => '50', 'placeholder' => 'Введите фамилию')) }}
                        @if ($errors->has('last_name'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span><br>
                        @endif
                    </div>
                </div>



                <div class="form-group row">
                    {{ Form::label('birthday', 'Дата рождения', ['class' => 'col-sm-3 col-form-label']) }}
                    <div class="col-sm-9">
                        {{ Form::date('birthday', isset($gamer) ? $gamer->birthday : null,
                            array('class' => 'form-control', 'required')) }}
                        @if ($errors->has('birthday'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('birthday') }}</strong>
                            </span><br>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    {{ Form::label('phone', 'Телефон', ['class' => 'col-sm-3 col-form-label']) }}
                    <div class="col-sm-9">
                        {{ Form::text('phone', old('phone'),
                            array('class' => 'form-control', 'required', 'maxlength' => '11',
                            'placeholder' => 'Введите телефон', 'pattern' => \App\Helpers\Constants::PhoneRegexPattern)) }}
                        @if ($errors->has('phone'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span><br>
                        @endif
                    </div>
                </div>


                <div class="form-group row">
                    {{ Form::label('email', 'Email', ['class' => 'col-sm-3 col-form-label']) }}
                    <div class="col-sm-9">
                        {{ Form::email('email', old('email'),
                                array('class' => 'form-control', 'required', 'maxlength' => '100',
                                'placeholder' => 'Введите email', 'pattern' => \App\Helpers\Constants::EmailRegexPattern)) }}
                        @if ($errors->has('email'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span><br>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="city">Город</label>
                    <div class="col-sm-9">
                        @renderCitiesSelect(old('city'), true)
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

                <div class="form-group row">
                    {{ Form::label('lead_id', 'ID лида', ['class' => 'col-sm-3 col-form-label']) }}
                    <div class="col-sm-9">
                        {{ Form::number('lead_id', old('lead_id'), array('class' => 'form-control')) }}
                        @if ($errors->has('lead_id'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('lead_id') }}</strong>
                            </span><br>
                        @endif
                    </div>
                </div>
                </p>
            </div>
        </div>
    </div>


    <div class="col-sm-6">

        <div class="card">
            <div class="card-block">
                <p class="card-text">

                <div class="form-group  row">
                    {{ Form::label('vk_page', 'Профиль Вконтакте', ['class' => 'col-sm-3 col-form-label']) }}
                    <div class="col-sm-9">
                        {{ Form::text('vk_page', old('vk_page'),
                            array('class' => 'form-control', 'required', 'pattern' => \App\Helpers\Constants::VkPageRegexPattern)) }}
                        @if ($errors->has('vk_page'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('vk_page') }}</strong>
                            </span><br>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="status">Статус</label>
                    <div class="col-sm-9">

                        {!! Form::select('status',
                                [
                                    '' => 'Статус',
                                    'student' => 'Студент',
                                    'pupil' => 'Школьник',
                                    'employee' => 'Работаю',
                                    'dumbass' => 'В активном поиске себя'
                                ],
                                old('status'), ['class' => 'form-control', 'required']
                            ) !!}
                        @if ($errors->has('status'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('status') }}</strong>
                            </span><br>
                        @endif
                    </div>
                </div>

                <div class="form-group  row">
                    {{ Form::label('institution', 'Учреждение', ['class' => 'col-sm-3 col-form-label']) }}
                    <div class="col-sm-9">
                        {{ Form::text('institution', old('institution'),
                            array('class' => 'form-control', 'required')) }}
                        @if ($errors->has('institution'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('institution') }}</strong>
                            </span><br>
                        @endif
                    </div>
                </div>

                </p>
            </div>
        </div>
    </div>

</div>

<div class="form-group">
    <button type="submit" id="submit-btn" class="btn btn-primary">Сохранить</button>

</div>