
<table class="table table-striped">
    <thead>
    <tr>
        <th>Игра</th>
        <th>Очки</th>
        <th>Прирост</th>
        <th>За месяц</th>
        <th>Добавить/убавить очки</th>
    </tr>
    </thead>
    <tbody>
    @foreach($team->scores as $score)

        @php( $monthChanged = $score->total_value - $score->month_value)
        <tr>
            <td>{{  $score->game_name }}</td>
            <td>{{ $score->total_value }}</td>
            <td>{{ $score->total_change }}</td>
            <td>{{ $monthChanged }}</td>
            <td>
                {!! Form::open(['method' => 'post', 'action' => ['TeamController@scoreUpdate', $team->id]]) !!}
                    <input type="hidden" name="team_id" value="{{$score->team_id}}">
                    <input type="hidden" name="game_name" value="{{$score->game_name}}">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <label class="form-check-label">
                                <input type="checkbox" name="with_gamers"  class="form-check-input">
                                Задействовать игроков
                            </label>
                        </span>

                        {{ Form::number('score_value', null/*$score->total_value*/,
                        array('class' => 'form-control', 'placeholder' => 'Введите число', 'required')) }}
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-outline-primary">Сохранить</button>
                        </span>
                    </div>
                {!! Form::close() !!}

            </td>
        </tr>
    @endforeach

    </tbody>
</table>
