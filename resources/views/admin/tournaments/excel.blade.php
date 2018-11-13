
@php
    /** @var \App\Models\Tournament $tournament */
    /** @var \App\Models\Team[] $participants */
    /** @var int $participantsCount */
    /*
Название команды
Город команды
Ф.И.О. каждого
Телефон каждого
HABB ID каждого
*/
@endphp
<table border="1px">
    <thead>
    <tr>
        <th>#</th>
        <th>Название команды</th>
        <th>Город</th>
        <th>Создана</th>
        <th>Ссылка на команду</th>

        <th>Капитан, HABB ID</th>
        <th>Капитан, Имя</th>
        <th>Капитан, телефон</th>
        <th>Капитан, Ссылка</th>

        <th>Игрок 2, HABB ID</th>
        <th>Игрок 2, Имя</th>
        <th>Игрок 2, телефон</th>
        <th>Игрок 2, Ссылка</th>

        <th>Игрок 3, HABB ID</th>
        <th>Игрок 3, Имя</th>
        <th>Игрок 3, телефон</th>
        <th>Игрок 3, Ссылка</th>

        <th>Игрок 4, HABB ID</th>
        <th>Игрок 4, Имя</th>
        <th>Игрок 4, телефон</th>
        <th>Игрок 4, Ссылка</th>

        <th>Игрок 5, HABB ID</th>
        <th>Игрок 5, Имя</th>
        <th>Игрок 5, телефон</th>
        <th>Игрок 5, Ссылка</th>

        <th>Запасной, HABB ID</th>
        <th>Запасной, Имя</th>
        <th>Запасной, телефон</th>
        <th>Запасной, Ссылка</th>
    </tr>
    </thead>

    <tbody>
    @for($index = 0; $index < $participantsCount; $index++)

        @php
            /** @var \App\Models\Team $team */
            $team = $participants[$index]
        @endphp

        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $team->name }}</td>
            <td>{{ $team->city }}</td>
            <td>{{ $team->CreatedAt() }}</td>
            <td>{{ action('TeamController@show', ['id' => $team->id]) }}</td>

            @php ($gamer = $team->captain)
            <td>{{ $gamer->id }}</td>
            <td>{{ $gamer->getFullName() }}</td>
            <td>{{ $gamer->phone }}</td>
            <td>{{ action('GamerController@show', ['id' => $gamer->id]) }}</td>

            @php ($gamer = $team->secondGamer)
            <td>{{ $gamer->id }}</td>
            <td>{{ $gamer->getFullName() }}</td>
            <td>{{ $gamer->phone }}</td>
            <td>{{ action('GamerController@show', ['id' => $gamer->id]) }}</td>

            @php ($gamer = $team->thirdGamer)
            <td>{{ $gamer->id }}</td>
            <td>{{ $gamer->getFullName() }}</td>
            <td>{{ $gamer->phone }}</td>
            <td>{{ action('GamerController@show', ['id' => $gamer->id]) }}</td>

            @php ($gamer = $team->forthGamer)
            <td>{{ $gamer->id }}</td>
            <td>{{ $gamer->getFullName() }}</td>
            <td>{{ $gamer->phone }}</td>
            <td>{{ action('GamerController@show', ['id' => $gamer->id]) }}</td>

            @php ($gamer = $team->fifthGamer)
            <td>{{ $gamer->id }}</td>
            <td>{{ $gamer->getFullName() }}</td>
            <td>{{ $gamer->phone }}</td>
            <td>{{ action('GamerController@show', ['id' => $gamer->id]) }}</td>

            @php ($gamer = $team->optionalGamer)

            @if (isset($gamer))
                <td>{{ $gamer->id }}</td>
                <td>{{ $gamer->getFullName() }}</td>
                <td>{{ $gamer->phone }}</td>
                <td>{{ action('GamerController@show', ['id' => $gamer->id]) }}</td>
            @else
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            @endif
        </tr>

    @endfor
    </tbody>

</table>