
<table border="1px">
    <thead>
    <tr>
        <th>HABB ID</th>

        <th>Имя</th>
        <th>Фамилия</th>

        <th>Телефон</th>
        <th>Email</th>
        <th>Город</th>

        <th>Дата рождения</th>
        <th>VK страница</th>

        <th>Занятость</th>
        <th>Учреждение</th>

        <th>Основная игра</th>
        <th>Другие игры</th>

        <th>Сторонний источник (если есть)</th>

        <th>Дата создания</th>
    </tr>
    </thead>
    <tbody>
        @php
            /** @var \App\Models\Gamer[] $model */
        @endphp
        @foreach($model as $gamer)

            @php

                if (isset($gamer->birthday))
                    $birthday = $gamer->birthday->toDateString();
                else
                    $birthday = null;

                if (isset($gamer->externalService))
                    $externalService = $gamer->externalService->title;
                else
                    $externalService = null;
            @endphp

            <tr>
                <td>{{ $gamer->id }}</td>

                <td>{{ $gamer->name }}</td>
                <td>{{ $gamer->last_name }}</td>

                <td>{{ $gamer->phone }}</td>
                <td>{{ $gamer->email }}</td>
                <td>{{ $gamer->city }}</td>

                <td>{{ $birthday }}</td>
                <td>{{ $gamer->vk_page }}</td>

                <td>{{ $gamer->status }}</td>
                <td>{{ $gamer->institution }}</td>

                <td>{{ $gamer->primary_game }}</td>
                <td>{{ $gamer->getSecondaryGamesAsString() }}</td>

                <td>{{ $externalService }}</td>

                <td>{{ $gamer->created_at->toDateString() }}</td>

            </tr>

        @endforeach

    </tbody>
</table>