
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

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Список игроков</th>
                <th>Роль</th>
            </tr>
            </thead>
            <tbody>
            @for($i = 0; $i < 7; $i++)
                @php
                    $options = [
                        'class' => 'form-control select2-single',
                        'id' => 'gamer_ids'
                    ];
                if($i < 3) $options['required'] = true;

                @endphp
                <tr>
                    <td>
                        {{ Form::select("gamer_ids[$i]", $gamerOptionList, old("gamer_ids[$i]"), $options) }}
                    </td>
                    <td>
                        {{ Form::select("gamer_roles[$i]", [
                                'gamer' => 'Игрок',
                                'captain' => 'Капитан',
                                'reserve' => 'Запасной',
                                'coach' => 'Тренер'
                            ], old("gamer_roles[$i]"), ['class'=>'form-control', 'id' => 'gamer_roles', 'required' => true]) }}
                    </td>
                </tr>
            @endfor
            </tbody>
        </table>
    </div>

</div>

<div class="form-group">
    <div class="float-sm-right">
        <button type="submit" id="submit-btn" class="btn btn-primary">Сохранить</button>
    </div>
</div>