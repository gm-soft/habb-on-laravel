
<div class="row">
    <div class="col-sm-6">
        <h3>Данные команды</h3>
        <input type="hidden" name="id" value="{{old('id')}}" >
        <div class="form-group">
            {{ Form::label('name', 'Название команды:') }}
            {{ Form::text('name', old('name'),
                    array('class' => 'form-control', 'maxlength' => '100', 'placeholder' => 'Введите название команды', 'required' => true)) }}
            @if ($errors->has('name'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('name') }}</strong>
                </span><br>
            @endif
            <small>Придумайте броское название, чтобы оно "врезалось" в память оппонентам</small>
        </div>

        <div class="form-group">
            {{ Form::label('city', 'Город команды') }}
            {{ Form::select('city', $cities, old('cities'), ['class'=>'form-control', 'required'=>true]) }}
            <small>Укажите, пожалуйста, город команды</small>
        </div>

        <div class="form-group">
            {{ Form::label('requester_name', 'Имя запросившего') }}
            {{ Form::text('requester_name', old('requester_name'),
                    array('class' => 'form-control', 'maxlength' => '100', 'placeholder' => 'Введите свое имя', 'required' => true)) }}
            @if ($errors->has('comment'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('requester_name') }}</strong>
                </span><br>
            @endif
            <small>Как нам к Вам обращаться?</small>
        </div>

        <div class="form-group">
            {{ Form::label('requester_phone', 'Телефон запросившего') }}
            {{ Form::text('requester_phone', old('requester_phone'),
                    array('class' => 'form-control', 'placeholder' => 'Введите номер телефона', 'required' => true, 'id' => 'phone')) }}
            @if ($errors->has('requester_phone'))
                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('requester_phone') }}</strong>
                                </span><br>
            @endif
            <small>Номер телефона необходим для связи с Вами в случае возникновения вопросов по поводу заявки</small>
        </div>

        <div class="form-group">
            {{ Form::label('requester_email', 'Email запросившего') }}
            {{ Form::text('requester_email', old('requester_email'),
                    array('class' => 'form-control', 'placeholder' => 'Введите свой email', 'pattern' => $emailRegPattern, 'required' => true)) }}
            @if ($errors->has('requester_email'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('requester_email') }}</strong>
                </span><br>
            @endif
            <small>Электронный адрес будет использован для отправки результата рассмотрения заявки</small>
        </div>
    </div>


    <div class="col-sm-6">
        <h3>Состав команды</h3>
        <p>Игрок, указанный первым, будет назначен капитаном</p>
        @for($i = 0; $i < 5; $i++)
            <div class="form-group row">
                <div class="col-sm-3">
                    {{ Form::number("participant_ids[$i]", old("requester_ids[$i]"),
                        array('class' => 'form-control', 'placeholder' => 'HABB ID', 'min'=> 0, 'required' => true)) }}
                </div>
                <div class="col-sm-9">
                    {{ Form::text("participant_names[$i]", old("requester_names[$i]"),
                        array('class' => 'form-control', 'placeholder' => 'Полное имя участника', 'required' => true)) }}
                </div>
            </div>
        @endfor


    </div>

</div>

<div class="form-group">
    <div class="float-sm-right">
        <button type="submit" id="submit-btn" class="btn btn-primary">Сохранить</button>
    </div>
</div>