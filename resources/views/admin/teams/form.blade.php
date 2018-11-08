
<div class="row">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="card-text">

                    <input type="hidden" name="id" value="{{old('id')}}" >
                    <div class="form-group row">
                        {{ Form::label('name', 'Название:', ['class' => 'col-sm-3 col-form-label']) }}
                        <div class="col-sm-9">
                            {{ Form::text('name', old('name'),
                                array('class' => 'form-control', 'required', 'maxlength' => '100', 'placeholder' => 'Введите название команды')) }}
                            @if ($errors->has('name'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('name') }}</strong>
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

                </div>
            </div>
        </div>
    </div>


    <div class="col-sm-6">

        <div class="form-group">
            {{ Form::label(\App\Models\Team::Captain_ForeignColumn, 'Капитан', ['class' => '']) }}
            {{ Form::select(\App\Models\Team::Captain_ForeignColumn, $gamerOptionList, old(\App\Models\Team::Captain_ForeignColumn), [
                                    'class' => 'form-control select2-single',
                                    'id' => \App\Models\Team::Captain_ForeignColumn,
                                    'required' => true
                                ]) }}

            @if ($errors->has(\App\Models\Team::Captain_ForeignColumn))
                <span class="help-block text-danger">
                        <strong>{{ $errors->first(\App\Models\Team::Captain_ForeignColumn) }}</strong>
                    </span><br>
            @endif
        </div>

        <div class="form-group">
            {{ Form::label(\App\Models\Team::SecondGamer_ForeignColumn, 'Второй игрок', ['class' => '']) }}
            {{ Form::select(\App\Models\Team::SecondGamer_ForeignColumn, $gamerOptionList, old(\App\Models\Team::SecondGamer_ForeignColumn), [
                                    'class' => 'form-control select2-single',
                                    'id' => \App\Models\Team::SecondGamer_ForeignColumn,
                                    'required' => true
                                ]) }}

            @if ($errors->has(\App\Models\Team::SecondGamer_ForeignColumn))
                <span class="help-block text-danger">
                        <strong>{{ $errors->first(\App\Models\Team::SecondGamer_ForeignColumn) }}</strong>
                    </span><br>
            @endif
        </div>

        <div class="form-group">
            {{ Form::label(\App\Models\Team::ThirdGamer_ForeignColumn, 'Третий игрок', ['class' => '']) }}
            {{ Form::select(\App\Models\Team::ThirdGamer_ForeignColumn, $gamerOptionList, old(\App\Models\Team::ThirdGamer_ForeignColumn), [
                                    'class' => 'form-control select2-single',
                                    'id' => \App\Models\Team::ThirdGamer_ForeignColumn,
                                    'required' => true
                                ]) }}

            @if ($errors->has(\App\Models\Team::ThirdGamer_ForeignColumn))
                <span class="help-block text-danger">
                        <strong>{{ $errors->first(\App\Models\Team::ThirdGamer_ForeignColumn) }}</strong>
                    </span><br>
            @endif
        </div>

        <div class="form-group">
            {{ Form::label(\App\Models\Team::ForthGamer_ForeignColumn, 'Четвертый игрок', ['class' => '']) }}
            {{ Form::select(\App\Models\Team::ForthGamer_ForeignColumn, $gamerOptionList, old(\App\Models\Team::ForthGamer_ForeignColumn), [
                                    'class' => 'form-control select2-single',
                                    'id' => \App\Models\Team::ForthGamer_ForeignColumn,
                                    'required' => true
                                ]) }}

            @if ($errors->has(\App\Models\Team::ForthGamer_ForeignColumn))
                <span class="help-block text-danger">
                        <strong>{{ $errors->first(\App\Models\Team::ForthGamer_ForeignColumn) }}</strong>
                    </span><br>
            @endif
        </div>

        <div class="form-group">
            {{ Form::label(\App\Models\Team::FifthGamer_ForeignColumn, 'Пятый игрок', ['class' => '']) }}
            {{ Form::select(\App\Models\Team::FifthGamer_ForeignColumn, $gamerOptionList, old(\App\Models\Team::FifthGamer_ForeignColumn), [
                                'class' => 'form-control select2-single',
                                'id' => \App\Models\Team::FifthGamer_ForeignColumn,
                                'required' => true
                            ]) }}

            @if ($errors->has(\App\Models\Team::FifthGamer_ForeignColumn))
                <span class="help-block text-danger">
                            <strong>{{ $errors->first(\App\Models\Team::FifthGamer_ForeignColumn) }}</strong>
                        </span><br>
            @endif
        </div>

        <div class="form-group">
            {{ Form::label(\App\Models\Team::OptionalGamer_ForeignColumn, 'Запасной игрок', ['class' => '']) }}

            {{

                    Form::select(\App\Models\Team::OptionalGamer_ForeignColumn, $gamerOptionList, old(\App\Models\Team::OptionalGamer_ForeignColumn), [
                                    'class' => 'form-control select2-single',
                                    'id' => \App\Models\Team::OptionalGamer_ForeignColumn,
                                    'required' => true
                                ])

                }}

            @if ($errors->has(\App\Models\Team::OptionalGamer_ForeignColumn))
                <span class="help-block text-danger">
                        <strong>{{ $errors->first(\App\Models\Team::OptionalGamer_ForeignColumn) }}</strong>
                    </span><br>
            @endif
        </div>
    </div>

</div>

<div class="form-group">
    <div class="float-sm-right">
        <button type="submit" id="submit-btn" class="btn btn-primary">Сохранить</button>
    </div>
</div>