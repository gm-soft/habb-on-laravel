
@extends('layouts.admin-layout')
@section('title', 'HABB-Админка | Баннеры')

@section('content')
    <div class="container mt-3">

        <h1 class="mt-1">Баннеры</h1>
        <div class="mb-1 text-sm-right">
            <a href="{{ action('BannerController@create')}}" class="btn btn-light">Создать запись</a>
        </div>

        <table class="table table-striped dataTable">
            <thead>
            <tr>
                <th>ID</th>
                <th>Заголовок</th>
                <th>На главной</th>
                <th>Привязан к турнирам</th>
                <th>Создан</th>
            </tr>
            </thead>
            <tbody>

            @for($i = 0; $i < $banners_count; $i++)
                <tr>
                    <td>{{ $banners[$i]->id }}</td>
                    <td><b>{{ link_to_action('BannerController@show', $banners[$i]->title ?? "<Без заголовка>", ['id' => $banners[$i]->id]) }}</b></td>
                    <td>{{ $banners[$i]->attached_to_main_page ? "Да"  : "Нет"  }}</td>
                    <td>{{ count($banners[$i]->tournaments()) }}</td>
                    <td>{{ $banners[$i]->created_at  }}</td>
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