
<table class="table table-striped">
    <thead>
    <tr>
        <th>HABB ID</th>
        <th>Имя</th>
        <th>Роль</th>
    </tr>
    </thead>
    <tbody>

    <tr>
        @php
            $gamer = $team->captain;
        @endphp
        <td>{{ $gamer->id }}</td>
        <td>{{ link_to_action('GamerController@show', $gamer->getFullName(), ['id' => $gamer->id]) }}</td>
        <td>Капитан</td>
    </tr>

    <tr>
        @php( $gamer = $team->secondGamer)
        <td>{{ $gamer->id }}</td>
        <td>{{ link_to_action('GamerController@show', $gamer->getFullName(), ['id' => $gamer->id]) }}</td>
        <td>Игрок 2</td>
    </tr>

    <tr>
        @php( $gamer = $team->thirdGamer)
        <td>{{ $gamer->id }}</td>
        <td>{{ link_to_action('GamerController@show', $gamer->getFullName(), ['id' => $gamer->id]) }}</td>
        <td>Игрок 3</td>
    </tr>

    <tr>
        @php( $captain = $team->forthGamer)
        <td>{{ $gamer->id }}</td>
        <td>{{ link_to_action('GamerController@show', $gamer->getFullName(), ['id' => $gamer->id]) }}</td>
        <td>Игрок 4</td>
    </tr>

    <tr>
        @php( $gamer = $team->fifthGamer)
        <td>{{ $gamer->id }}</td>
        <td>{{ link_to_action('GamerController@show', $gamer->getFullName(), ['id' => $gamer->id]) }}</td>
        <td>Игрок 5</td>
    </tr>

    @php($gamer = $team->optionalGamer)
    @if(isset($gamer))

        <tr>

            <td>{{ $gamer->id }}</td>
            <td>{{ link_to_action('GamerController@show', $gamer->getFullName(), ['id' => $gamer->id]) }}</td>
            <td>Запасной игрок</td>
        </tr>

    @endif



    </tbody>
</table>