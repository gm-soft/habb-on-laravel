
<div class="row">
    <div class="col-sm-6">
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
            {{ Form::label('tournament_type', 'Тип турнира: Командный/индивидуальный') }}
            {{ Form::select("tournament_type", [
                                'team' => 'Командный',
                                'gamer' => 'Индивидуальный',
                            ], old("tournament_type"), ['class'=>'form-control', 'required' => true, 'id' => 'tournament_type']) }}
            @if ($errors->has('tournament_type'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('tournament_type') }}</strong>
                </span><br>
            @endif
        </div>

        <div class="form-group">
            {{ Form::label('game', 'Игровая дисциплина') }}
            {{ Form::select("game", $games, old("game"), ['class'=>'form-control', 'required' => true]) }}
            @if ($errors->has('game'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('game') }}</strong>
                </span><br>
            @endif
        </div>

        <div class="form-group">
            {{ Form::label('participant_max_count', 'Максимальное кол-во участников') }}
            {{ Form::number('participant_max_count', old('participant_max_count'),
                    array('class' => 'form-control', 'required'=> true, 'placeholder' => 'Введите максимальное кол-во участников турнира')) }}
            @if ($errors->has('participant_max_count'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('participant_max_count') }}</strong>
                </span><br>
            @endif
        </div>

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


    <div class="col-sm-6">

        <div class="form-group">
            {{ Form::label('part_select', 'Выберите участника и нажмите "Добавить"') }}
            <div class="row">
                <div class="col-sm-8">
                    {{ Form::select("part_select", $participants, null, ['class'=>'form-control select2-single', 'id' => 'part_select']) }}
                </div>
                <div class="col-sm-4 text-sm-right">
                    <a href="#" id="addPartButton" class="btn btn-primary">Добавить</a>
                </div>
            </div>

        </div>

        <h4>Выбранные участники</h4>
        <div id="outputDiv">
            @if($current_participants ?? null)
                @for($i = 0; $i < count($current_participants); $i++)

                    <div id="participant_{{ $current_participants[$i]->getIdentifier() }}" class="row mt-1">
                        <div class="col-sm-8">
                            <b>{{ $current_participants[$i]->getName() }}</b>
                            <input type="hidden" name="participant_ids[]" value="{{ $current_participants[$i]->getIdentifier() }}">
                        </div>

                        <div class="col-sm-4 text-sm-right">
                            <a href="#" class="btn btn-outline-danger" onclick="tournamentHelper.deleteParticipantDiv({{ $current_participants[$i]->getIdentifier() }})">
                                Удалить <i class="fa fa-times" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>

                @endfor
            @endif
        </div>
    </div>

</div>

<div class="form-group">
    <div class="float-sm-right">
        <button type="submit" id="submit-btn" class="btn btn-primary">Сохранить</button>
    </div>
</div>