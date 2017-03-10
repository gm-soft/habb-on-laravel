
<table class="table table-sm">
    <thead>
    <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>Очки</th>
    </tr>
    </thead>
    <tbody>
    @foreach($gamers as $gamer)

        @php
            /** @var \App\Models\GamerScore[] $scores */
            $scores = $gamer->scores;
            $fullName = $gamer->name. " " . $gamer->last_name;

        @endphp
        <tr>
            <td>{{  $gamer->id }}</td>
            <td>{{ link_to_action('GamerController@show', $fullName, ['id' => $gamer->id]) }}</td>
            <td>
                <ul>
                    <li>{{ $scores[0]->game_name }}: <span class="float-sm-right">{{ $scores[0]->total_value }}</span></li>
                    <li>{{ $scores[1]->game_name }}: <span class="float-sm-right">{{ $scores[1]->total_value }}</span></li>
                    <li>{{ $scores[2]->game_name }}: <span class="float-sm-right">{{ $scores[2]->total_value }}</span></li>
                </ul>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>