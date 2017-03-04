
<div class="row">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title">Личная информация</h4>
                <p class="card-text">

                <input type="hidden" name="id" value="{{old('id')}}" >



                <div class="form-group row">
                    {{ Form::label('name', 'Имя:', ['class' => 'col-sm-3 col-form-label']) }}
                    <div class="col-sm-9">
                        <!--input type="text" id="name" name="name" class="form-control"
                               required placeholder="Введите имя (50)" maxlength="50" value="{{old('name')}}" -->
                        {{ Form::text('name', old('name'),
                            array('class' => 'form-control', 'required', 'maxlength' => '50', 'placeholder' => 'Введите имя')) }}
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="last_name">Фамилия</label>
                    <div class="col-sm-9">
                        <input type="text" id="last_name" name="last_name" class="form-control"
                               required placeholder="Введите фамилию (50)" maxlength="50" value="{{old('last_name')}}">
                    </div>
                </div>



                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="birthday">Дата рождения</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" id="birthday" name="birthday" required  value="{{old('birthday')}}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="phone">Телефон</label>
                    <div class="col-sm-9">
                        <input type="tel" class="form-control" id="phone" name="phone" pattern="@PhoneFieldPattern()"
                               required placeholder="Введите мобильный телефон"  value="{{old('phone')}}">
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="email">Email</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="email" name="email" pattern="@EmailFieldPattern()"
                               required placeholder="Введите email" maxlength="50" value="{{old('email')}}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="city">Город</label>
                    <div class="col-sm-9">
                        @renderCitiesSelect(old('city'), true)
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="comment">Коментарий</label>
                    <div class="col-sm-9">
                            <textarea class="form-control" id="comment" name="comment"
                                      placeholder="Максимум 250 символов"  maxlength="250">{{old('comment')}}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="lead_id">Лид в Б24</label>
                    <div class="col-sm-9">
                        <input type="number" id="lead_id" name="lead_id" class="form-control" maxlength="50" value="{{old('lead_id')}}" >
                    </div>
                </div>
                </p>
            </div>
        </div>
    </div>


    <div class="col-sm-6">

        <div class="card">
            <div class="card-block">
                <h4 class="card-title">Соц-сети</h4>
                <p class="card-text">

                <div class="form-group  row">
                    <label class="col-sm-3 col-form-label" for="vk_page">Профиль vk</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="vk_page" name="vk_page"
                               required placeholder="Ссылка на профиль vk" maxlength="40" value="{{old('vk_page')}}">
                    </div>
                </div>
                </p>
            </div>
        </div>

        <div class="card">
            <div class="card-block">
                <h4 class="card-title">Статус</h4>
                <p class="card-text">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="status">Статус</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="status" name="status" required>
                            <?php
                            $status = old('status');
                            ?>
                            <option value="" disabled <?=$status == "" ? "selected" : "" ?>>Статус</option>
                            <option value="student" <?=$status == "student" ? "selected" : "" ?>>Студент</option>
                            <option value="pupil" <?=$status == "pupil" ? "selected" : "" ?>>Школьник</option>
                            <option value="employee" <?=$status == "employee" ? "selected" : "" ?>>Работаю</option>
                            <option value="dumbass" <?=$status == "dumbass" ? "selected" : "" ?>>В активном поиске себя</option>
                        </select>
                    </div>
                </div>

                <div class="form-group  row">
                    <label class="col-sm-3 col-form-label" for="institution">Название учреждения</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="institution" name="institution"
                               placeholder="Название учреждения" required maxlength="50" value="{{old('institution')}}">
                    </div>
                </div>
                </p>
            </div>
        </div>


        <div class="card">
            <div class="card-block">
                <h4 class="card-title">Игры</h4>
                <p class="card-text">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="primary_game">Активно играет</label>
                    <div class="col-sm-9">
                        <select class="form-control select2 select2-single" name="primary_game" required>
                            <option value="" selected disabled>Играю активно</option>
                            <option value="dota">Dota</option>
                            <option value="cs:go">CS:GO</option>
                            <option value="lol">League of Legends</option>
                            <option value="hearthstone">Hearthstone</option>
                            <option value="wot">World of Tanks</option>
                            <option value="overwatch">Overwatch</option>
                            <option value="cod">Call of Duty (серия игр)</option>
                        </select>

                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="secondary_games">Другие игры</label>
                    <div class="col-sm-9">
                        <select class="form-control select2 select2-multiple" name="secondary_games[]" required multiple="multiple" >
                            <option value="dota">Dota</option>
                            <option value="cs:go">CS:GO</option>
                            <option value="lol">League of Legends</option>
                            <option value="hearthstone">Hearthstone</option>
                            <option value="wot">World of Tanks</option>
                            <option value="overwatch">Overwatch</option>
                            <option value="cod">Call of Duty (серия игр)</option>
                        </select>
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