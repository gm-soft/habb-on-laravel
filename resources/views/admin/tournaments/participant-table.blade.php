

@if($participants ?? false)
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Имя/название</th>
                <th>Очки</th>
            </tr>
        </thead>
        <tbody>
            @for($i = 0; $i < count($participants); $i++)
                @php
                    $score = $instance->participant_scores[$i];
                    if($participants[$i]->getClass() == 'gamer') {
                        $link = url('admin/gamers/'.$participants[$i]->getIdentifier());
                    } else{
                        $link = url('admin/teams/'.$participants[$i]->getIdentifier());
                    }
                @endphp
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td><a href="{{ $link }}">{{ $participants[$i]->getName() }}</a></td>
                    <td>{{ $score }}</td>
                </tr>

            @endfor
        </tbody>
    </table>

@else
    <p>
        В турнире нет участвующих команд или игроков
    </p>
@endif