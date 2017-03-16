
@extends('layouts.admin-layout')
@section('title', 'Список постов')

@section('content')
    <div class="container">
        <h1 class="mt-1">Посты</h1>
        <div class="mb-1">
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
            </tr>
            </thead>
            <tbody>
            @for($i=0;$i<count($posts);$i++)
                @php($name = $posts[$i]->title)
                <tr>
                    <td>{{ $posts[$i]->id }}</td>
                    <td>{{ link_to_action('PostController@show', $name, ['id' => $posts[$i]->id]) }}</td>
                    <td>{{ $posts[$i]->getContentLength()  }}</td>
                    <td>{{ $posts[$i]->views  }}</td>
                    <td>{{ $posts[$i]->updated_at  }}</td>
                </tr>

            @endfor

            </tbody>
        </table>
    </div>

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