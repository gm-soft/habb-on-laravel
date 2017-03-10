
@extends(\App\Helpers\Constants::BackLayoutPath)
@section('title', 'Команды Habb')

@section('content')
    <div class="row mt-2 mb-1">

        <div class="col-sm-6">
            <h1>Команды</h1>
        </div>

        <div class="col-sm-6 text-sm-right">
            <a href="{{url('admin/teams/create')}}" class="btn btn-secondary">Создать запись</a>
        </div>
    </div>
    <table class="table table-striped dataTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Капитан</th>
                <th>Email</th>
                <th>VK страница</th>
                <th>Игра</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @for($i=0;$i<count($teams);$i++)

                <tr>
                    <td>{{ $teams[$i]->id }}</td>
                    <td>{{ $teams[$i]->name}}</td>
                    <td>{{ $teams[$i]->phone  }}</td>
                    <td>{{ $teams[$i]->email  }}</td>
                    <td>{{ $teams[$i]->vk_page  }}</td>
                    <td>{{ $teams[$i]->primary_game  }}</td>
                    <td>
                        {{ link_to_action('TeamController@show', 'Открыть', ['id' => $teams[$i]->id]) }}
                        {{ link_to_action('TeamController@edit', 'Редактировать', ['id' => $teams[$i]->id]) }}
                    </td>
                </tr>

            @endfor

        </tbody>
    </table>

@endsection

@section('scripts')
    <script src="{{ asset('js/dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.dataTable').DataTable();
        });
    </script>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">
@endsection