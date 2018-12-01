
{!! Form::open(['action' => ['RegisterFormController@saveTeamRegisterForTournament'], 'id' => 'form']) !!}

<div class="row">

    <div class="col-md-6">
        <h3>Команда</h3>

        <input type="hidden" name="tournamentId" value="{{$model->tournamentId}}" >
        <input type="hidden" name="shared_by_habb_id" value="{{$model->sharedByHabbId}}" >

        <div class="form-group {{ $errors->has('name') ? "has-danger" : "" }}">
            {{ Form::label('name', 'Название команды:')}}
            {{ Form::text('name', old('name'),
                    array('class' => 'form-control', 'maxlength' => '100', 'placeholder' => 'Введите название команды', 'required' => true)) }}

            @if ($errors->has('name'))
                <span class="form-control-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span><br>
            @endif

            <small>Придумайте броское название, чтобы оно "врезалось" в память оппонентам</small>
        </div>

        <div class="form-group">
            {{ Form::label('city', 'Из какого вы города')}}
            <select class="form-control" name="city" required title="Выберите город">
                <option value="" disabled selected>Город</option>
                @for($i = 0; $i < count($model->cities); $i++)
                    <option value='{{ $model->cities[$i] }}'>{{ $model->cities[$i] }}</option>
                @endfor
            </select>
            <small>Укажите, пожалуйста, город команды</small>
        </div>

        <div class="form-group {{ $errors->has('captain_phone') ? "has-danger" : "" }}">
            <div class="text-nowrap">
                {{ Form::label('captain_phone', 'Мобильный телефон капитана *') }}
            </div>
            {{ Form::input('tel', 'captain_phone', old('captain_phone'),
                ['class' => 'form-control',
                 'id' => 'captain_phone',
                 'maxlength' => '14',
                 'placeholder' => 'Мобильный телефон',
                 'required' => true]) }}

            @if ($errors->has('captain_phone'))
                <span class="form-control-feedback">
                    <strong>{{ $errors->first('captain_phone') }}</strong>
                </span><br>
            @endif
            <small>Номер телефона необходим, чтобы мы могли связаться с вами в случае появления каких-то проблем</small>
        </div>

    </div>

    <div class="col-md-6">

        <h3>Участники</h3>

        <div class="form-group">
            <small>Заполните в поля ниже HABB ID участников команды. Разрешены только цифры. Обязательные поля помечены знаком <b>*</b></small>
        </div>

        <div class="form-group row {{ $errors->has(\App\Models\Team::Captain_ForeignColumn) ? "has-danger" : "" }}">
            <div class="col-sm-4 text-nowrap">
                {{ Form::label(\App\Models\Team::Captain_ForeignColumn, 'Капитан *') }}
            </div>
            <div class="col-sm-8">
                {{ Form::input('tel', \App\Models\Team::Captain_ForeignColumn, old(\App\Models\Team::Captain_ForeignColumn),
                ['class' => 'form-control',
                 'maxlength' => '10',
                 'placeholder' => 'HABB ID капитана',
                 'required' => true,
                 'pattern' => \App\Helpers\Constants::DigitsOnlyRegexPattern]) }}

                @if ($errors->has(\App\Models\Team::Captain_ForeignColumn))
                    <span class="form-control-feedback">
                            <strong>{{ $errors->first(\App\Models\Team::Captain_ForeignColumn) }}</strong>
                        </span><br>
                @endif
            </div>
        </div>

        <div class="form-group row {{ $errors->has(\App\Models\Team::SecondGamer_ForeignColumn) ? "has-danger" : "" }}">
            <div class="col-sm-4 text-nowrap">
                {{ Form::label(\App\Models\Team::SecondGamer_ForeignColumn, 'Второй игрок: *') }}
            </div>
            <div class="col-sm-8">
                {{ Form::input('tel', \App\Models\Team::SecondGamer_ForeignColumn, old(\App\Models\Team::SecondGamer_ForeignColumn),
                ['class' => 'form-control',
                 'maxlength' => '10',
                 'placeholder' => 'HABB ID второго игрока',
                 'required' => true,
                 'pattern' => \App\Helpers\Constants::DigitsOnlyRegexPattern]) }}

                @if ($errors->has(\App\Models\Team::SecondGamer_ForeignColumn))
                    <span class="form-control-feedback">
                            <strong>{{ $errors->first(\App\Models\Team::SecondGamer_ForeignColumn) }}</strong>
                        </span><br>
                @endif
            </div>


        </div>

        <div class="form-group row {{ $errors->has(\App\Models\Team::ThirdGamer_ForeignColumn) ? "has-danger" : "" }}">
            <div class="col-sm-4 text-nowrap">
                {{ Form::label(\App\Models\Team::ThirdGamer_ForeignColumn, 'Третий игрок: *') }}
            </div>
            <div class="col-sm-8">
                {{ Form::input('tel', \App\Models\Team::ThirdGamer_ForeignColumn, old(\App\Models\Team::ThirdGamer_ForeignColumn),
                ['class' => 'form-control',
                 'maxlength' => '10',
                 'placeholder' => 'HABB ID третьего игрока',
                 'required' => true,
                 'pattern' => \App\Helpers\Constants::DigitsOnlyRegexPattern]) }}

                @if ($errors->has(\App\Models\Team::ThirdGamer_ForeignColumn))
                    <span class="form-control-feedback">
                            <strong>{{ $errors->first(\App\Models\Team::ThirdGamer_ForeignColumn) }}</strong>
                        </span><br>
                @endif
            </div>


        </div>

        <div class="form-group row {{ $errors->has(\App\Models\Team::ForthGamer_ForeignColumn) ? "has-danger" : "" }}">
            <div class="col-sm-4 text-nowrap">
                {{ Form::label(\App\Models\Team::ForthGamer_ForeignColumn, 'Четвертый игрок: *') }}
            </div>
            <div class="col-sm-8">

                {{ Form::input('tel', \App\Models\Team::ForthGamer_ForeignColumn, old(\App\Models\Team::ForthGamer_ForeignColumn),
                    ['class' => 'form-control',
                     'maxlength' => '10',
                     'placeholder' => 'HABB ID четвертого игрока',
                     'required' => true,
                     'pattern' => \App\Helpers\Constants::DigitsOnlyRegexPattern]) }}

                @if ($errors->has(\App\Models\Team::ForthGamer_ForeignColumn))
                    <span class="form-control-feedback">
                            <strong>{{ $errors->first(\App\Models\Team::ForthGamer_ForeignColumn) }}</strong>
                        </span><br>
                @endif
            </div>

        </div>

        <div class="form-group row {{ $errors->has(\App\Models\Team::FifthGamer_ForeignColumn) ? "has-danger" : "" }}">
            <div class="col-sm-4 text-nowrap">
                {{ Form::label(\App\Models\Team::FifthGamer_ForeignColumn, 'Пятый игрок: *') }}
            </div>
            <div class="col-sm-8">
                {{ Form::input('tel', \App\Models\Team::FifthGamer_ForeignColumn, old(\App\Models\Team::FifthGamer_ForeignColumn),
                ['class' => 'form-control',
                 'maxlength' => '10',
                 'placeholder' => 'HABB ID пятого игрока',
                 'required' => true,
                 'pattern' => \App\Helpers\Constants::DigitsOnlyRegexPattern]) }}

                @if ($errors->has(\App\Models\Team::FifthGamer_ForeignColumn))
                    <span class="form-control-feedback">
                            <strong>{{ $errors->first(\App\Models\Team::FifthGamer_ForeignColumn) }}</strong>
                        </span><br>
                @endif
            </div>


        </div>

        <div class="form-group row {{ $errors->has(\App\Models\Team::OptionalGamer_ForeignColumn) ? "has-danger" : "" }}">
            <div class="col-sm-4 text-nowrap">
                {{ Form::label(\App\Models\Team::OptionalGamer_ForeignColumn, 'Запасной игрок:') }}
            </div>
            <div class="col-sm-8">
                {{ Form::input('tel', \App\Models\Team::OptionalGamer_ForeignColumn, old(\App\Models\Team::OptionalGamer_ForeignColumn),
                ['class' => 'form-control',
                 'maxlength' => '10',
                 'placeholder' => 'HABB ID запасного игрока',
                 'pattern' => \App\Helpers\Constants::DigitsOnlyRegexPattern]) }}

                @if ($errors->has(\App\Models\Team::OptionalGamer_ForeignColumn))
                    <span class="form-control-feedback">
                            <strong>{{ $errors->first(\App\Models\Team::OptionalGamer_ForeignColumn) }}</strong>
                        </span><br>
                @endif
                <small>Если нет запасного игрока, то можете не заполнять поле</small>
            </div>


        </div>

    </div>

</div>

<div class="form-group form-check">
    <label class="form-check-label">
        <input type="checkbox" class="form-check-input" id="inqured" name="inqured" required>
        Ознакомлен с <a href="#" data-toggle="modal" data-target="#resolution">условиями</a> и даю согласие на обработку моих данных
    </label>
</div>

<div class="form-group">
    <button type="submit" id="submit-btn" class="btn btn-primary btn-lg btn-block">Отправить заявку</button>
</div>
{!! Form::close() !!}