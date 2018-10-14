
@extends('layouts.admin-layout')
@section('title', 'HABB | Статичные страницы')

@section('content')
    <div class="container">
        <h1 class="mt-3">Статичные страницы</h1>

        <table class="table table-striped dataTable">
            <thead>
            <tr>
                <th>Уникальное имя</th>
                <th>Заголовок</th>
                <th>Размер контента</th>
                <th>Последняя редакция</th>
            </tr>
            </thead>
            <tbody>
            @for($i = 0; $i < count($static_pages); $i++)
                <tr>
                    <td>{{ $static_pages[$i]->unique_name }}</td>
                    <td>{{ link_to_action('StaticPageController@show', $static_pages[$i]->title, ['id' => $static_pages[$i]->id]) }}</td>
                    <td>{{ $static_pages[$i]->getContentLength()  }}</td>
                    <td>{{ $static_pages[$i]->UpdatedAt()  }}</td>
                </tr>

            @endfor

            </tbody>
        </table>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('thirdparty/dataTables/dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.dataTable').DataTable();
        });
    </script>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('thirdparty/dataTables/dataTables.min.css') }}">
@endsection