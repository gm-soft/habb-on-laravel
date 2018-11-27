
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
        <th>HABB ID (Если есть)</th>
        <th>ФИО</th>
        <th>Телефон</th>
        <th>Email</th>
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