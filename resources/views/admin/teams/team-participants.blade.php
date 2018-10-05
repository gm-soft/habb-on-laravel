
<table class="table table-sm">
    <thead>
    <tr>
        <th>ID</th>
        <th>Имя</th>
    </tr>
    </thead>
    <tbody>
    @foreach($gamers as $gamer)

        @php
            $fullName = $gamer->name. " " . $gamer->last_name;

        @endphp
        <tr>
            <td>{{  $gamer->id }}</td>
            <td>{{ link_to_action('GamerController@show', $fullName, ['id' => $gamer->id]) }}</td>
        </tr>
    @endforeach

    </tbody>
</table>