

@if($participants ?? false)
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Имя/название</th>
                <th>Очки (турнир)</th>
                <th>Очки ({{ $instance->game }})</th>
                <th>Действие</th>
            </tr>
        </thead>
        <tbody>
            @for($i = 0; $i < count($participants); $i++)
                @php
                    $tournamentScore = $instance->participant_scores[$i];
                    $id = $participants[$i]->getIdentifier();
                    $participantScore = $participants[$i]->getScore($instance->game);

                    if($participants[$i]->getClass() == 'gamer') {
                        $link = url('admin/gamers/'.$id);
                    } else{
                        $link = url('admin/teams/'.$id);
                    }
                @endphp
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td><a href="{{ $link }}">{{ $participants[$i]->getName() }}</a></td>
                    <td>{{ $tournamentScore }}</td>
                    <td>{{ $participantScore->total_value }}</td>
                    <td>
                        {!! Form::open(['method' => 'post', 'action' => ['TournamentController@scoreUpdate']]) !!}
                            <input type="hidden" name="tournament_id" value="{{ $instance->id }}">
                            <input type="hidden" name="participant_id" value="{{ $id }}">
                            <input type="hidden" name="game" value="{{ $instance->game }}">
                            <div class="input-group">
                                @if($participants[$i]->getClass() == 'team')
                                    <span class="input-group-addon">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="with_gamers"  class="form-check-input">
                                            С игроками
                                        </label>
                                    </span>
                                @endif

                                {{ Form::number('score_value', null,
                                    ['class' => 'form-control', 'placeholder' => 'Введите число', 'required']) }}
                                <span class="input-group-btn">
                                <button type="submit" class="btn btn-outline-primary"><i class="fa fa-check" aria-hidden="true"></i></button>
                            </span>
                            </div>
                        {!! Form::close() !!}
                    </td>
                </tr>

            @endfor
        </tbody>
    </table>

@else
    <p>
        В турнире нет участвующих команд или игроков
    </p>
@endif