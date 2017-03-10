
@extends(\App\Helpers\Constants::BackLayoutPath)
@section('title', 'Список постов')

@section('content')
    <h1>Посты</h1>
    <div>
        <a href="{{url('admin/posts/create')}}">Создать запись</a>
    </div>

    <table class="table table-striped dataTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Заголовок</th>
                <th>Размер контента</th>
                <th>Просмотры</th>
                <th>Опубликован</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @for($i=0;$i<count($posts);$i++)

                <tr>
                    <td>{{ $posts[$i]->id }}</td>
                    <td>{{ $posts[$i]->title}}</td>
                    <td>{{ $posts[$i]->getContentLength()  }}</td>
                    <td>{{ $posts[$i]->views  }}</td>
                    <td>{{ $posts[$i]->updated_at  }}</td>
                    <td>
                        {{ link_to_action('PostController@show', 'Открыть', ['id' => $posts[$i]->id]) }}
                        {{ link_to_action('PostController@edit', 'Редактировать', ['id' => $posts[$i]->id]) }}
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