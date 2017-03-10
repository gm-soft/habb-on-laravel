
<table class="table table-striped">
    <thead>
    <tr>
        <th>ID</th>
        <th>Имя</th>
        <th colspan="3">Очки</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
    @php
        $gamers = $team->getGamers();

    @endphp
    @foreach($gamers as $gamer)

        @php
            /** @var \App\Models\GamerScore[] $scores */
            $scores = $gamer->scores;
            $monthChanged = $score->total_value - $score->month_value

        @endphp
        <tr>
            <td>{{  $gamer->id }}</td>
            <td>{{ $gamer->name }} {{ $gamer->last_name }}</td>
            <td>{{ $scores[0]->total_change }}</td>
            <td>{{ $scores[1]->total_change }}</td>
            <td>{{ $scores[2]->total_change }}</td>
            <td>
                {{ link_to_action('GamerController@show', 'Открыть', ['id' => $gamer->id]) }}

            </td>
        </tr>
    @endforeach

    </tbody>
</table>