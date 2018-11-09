
<table class="table table-striped">
    <thead>
    <tr>
        <th>HABB ID</th>
        <th>Имя</th>
        <th>Роль</th>
        <th>Телефон</th>
        <th>VK</th>
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
        <td>{{ $gamer->phone }}</td>
        <td><a href="{{ $gamer->vk_page }}" target="_blank" title="Открыть в новой вкладке">{{ $gamer->vk_page }}</a></td>
    </tr>

    <tr>
        @php( $gamer = $team->secondGamer)
        <td>{{ $gamer->id }}</td>
        <td>{{ link_to_action('GamerController@show', $gamer->getFullName(), ['id' => $gamer->id]) }}</td>
        <td>Игрок 2</td>
        <td>{{ $gamer->phone }}</td>
        <td><a href="{{ $gamer->vk_page }}" target="_blank" title="Открыть в новой вкладке">{{ $gamer->vk_page }}</a></td>
    </tr>

    <tr>
        @php( $gamer = $team->thirdGamer)
        <td>{{ $gamer->id }}</td>
        <td>{{ link_to_action('GamerController@show', $gamer->getFullName(), ['id' => $gamer->id]) }}</td>
        <td>Игрок 3</td>
        <td>{{ $gamer->phone }}</td>
        <td><a href="{{ $gamer->vk_page }}" target="_blank" title="Открыть в новой вкладке">{{ $gamer->vk_page }}</a></td>
    </tr>

    <tr>
        @php( $captain = $team->forthGamer)
        <td>{{ $gamer->id }}</td>
        <td>{{ link_to_action('GamerController@show', $gamer->getFullName(), ['id' => $gamer->id]) }}</td>
        <td>Игрок 4</td>
        <td>{{ $gamer->phone }}</td>
        <td><a href="{{ $gamer->vk_page }}" target="_blank" title="Открыть в новой вкладке">{{ $gamer->vk_page }}</a></td>
    </tr>

    <tr>
        @php( $gamer = $team->fifthGamer)
        <td>{{ $gamer->id }}</td>
        <td>{{ link_to_action('GamerController@show', $gamer->getFullName(), ['id' => $gamer->id]) }}</td>
        <td>Игрок 5</td>
        <td>{{ $gamer->phone }}</td>
        <td><a href="{{ $gamer->vk_page }}" target="_blank" title="Открыть в новой вкладке">{{ $gamer->vk_page }}</a></td>
    </tr>

    @php($gamer = $team->optionalGamer)
    @if(isset($gamer))

        <tr>

            <td>{{ $gamer->id }}</td>
            <td>{{ link_to_action('GamerController@show', $gamer->getFullName(), ['id' => $gamer->id]) }}</td>
            <td>Запасной игрок</td>
            <td>{{ $gamer->phone }}</td>
            <td><a href="{{ $gamer->vk_page }}" target="_blank" title="Открыть в новой вкладке">{{ $gamer->vk_page }}</a></td>
        </tr>

    @endif



    </tbody>
</table>