
@extends(\App\Helpers\Constants::BackLayoutPath)
@section('title', 'Список игроков')

@section('content')
    <h1>Игроки</h1>

    <div>
        <a href="{{url('back/gamers/create')}}">Создать запись</a>
    </div>

    <table class="table table-striped dataTable">
        <thead>
            <tr>
                <th>#</th>
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
                    <td>{{$i+1}}</td>
                    <td>{{ $gamers[$i]->id }}</td>
                    <td>{{ $gamers[$i]->name}} {{$gamers[$i]->last_name}}</td>
                    <td>{{ $gamers[$i]->phone  }}</td>
                    <td>{{ $gamers[$i]->email  }}</td>
                    <td>{{ $gamers[$i]->vk_page  }}</td>
                    <td>
                        <a href='{{ url('back/gamers/show', ['id' => $gamers[$i]->id]) }}'>Открыть</a>
                        <a href='{{ url('back/gamers/edit', ['id' => $gamers[$i]->id]) }}'>Редактировать</a>
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