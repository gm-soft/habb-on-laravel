
@extends(\App\Helpers\Constants::BackLayoutPath)
@section('title', 'Список игроков')

@section('content')
    <h1>Игроки</h1>

    <div>
        <a href="{{url('admin/gamers/create')}}">Создать запись</a>
    </div>

    <table class="table table-striped dataTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Телефон</th>
                <th>Email</th>
                <th>VK страница</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @for($i=0;$i<count($gamers);$i++)

                <tr>
                    <td>{{ $gamers[$i]->id }}</td>
                    <td>{{ $gamers[$i]->name}} {{$gamers[$i]->last_name}}</td>
                    <td>{{ $gamers[$i]->phone  }}</td>
                    <td>{{ $gamers[$i]->email  }}</td>
                    <td>{{ $gamers[$i]->vk_page  }}</td>
                    <td>
                        {{ link_to_action('GamerController@show', 'Открыть', ['id' => $gamers[$i]->id]) }}
                        {{ link_to_action('GamerController@edit', 'Редактировать', ['id' => $gamers[$i]->id]) }}
                    </td>
                </tr>

            @endfor

        </tbody>
    </table>

@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $('.dataTable').DataTable();
    });
</script>
@endsection