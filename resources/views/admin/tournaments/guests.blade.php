
@php
    /** @var \App\Models\Tournament $tournament */
    /** @var \App\Models\Gamer[] $guests */
    /** @var int $guestsCount */
@endphp
<table border="1px">
    <thead>
    <tr>
        <th>#</th>
        <th>HABB ID (Если есть)</th>
        <th>ФИО</th>
        <th>Телефон</th>
        <th>Email</th>
        <th>Ссылка на аккаунт</th>
    </tr>
    </thead>

    <tbody>
    @for($index = 0; $index < $guestsCount; $index++)

        @php
            /** @var \App\Models\Gamer $gamer */
            $gamer = $guests[$index]
        @endphp

        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $gamer->is_active ? $gamer->id : "-" }}</td>
            <td>{{ $gamer->getFullName() }}</td>
            <td>{{ $gamer->phone }}</td>
            <td>{{ $gamer->email }}</td>
            <td>{{ action('GamerController@show', ['id' => $gamer->id]) }}</td>
        </tr>

    @endfor
    </tbody>

</table>