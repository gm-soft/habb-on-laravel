
@php
    /** @var \App\ViewModels\Back\GamerShowViewModel $model */
@endphp

<table class="table table-striped">
    <thead>
    <tr>
        <th>Игра</th>
        <th>Очки</th>
        <th>Прирост</th>
        <th>За месяц</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
    @foreach($model->gamer->scores as $score)

        @php( $monthChanged = $score->total_value - $score->month_value)
        <tr>
            <td>{{  $score->game_name }}</td>
            <td>{{ $score->total_value }}</td>
            <td>{{ $score->total_change }}</td>
            <td>{{ $monthChanged }}</td>
            <td>
                {!! Form::open(['method' => 'post', 'action' => ['GamerController@scoreUpdate', $model->gamer->id]]) !!}
                <input type="hidden" name="gamer_id" value="{{$score->gamer_id}}">
                <input type="hidden" name="game_name" value="{{$score->game_name}}">
                <div class="input-group">
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
