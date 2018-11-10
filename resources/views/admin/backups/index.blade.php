
@extends('layouts.admin-layout')
@section('title', 'HABB-Админка | Бэкапы')

@section('content')
    <div class="container mt-3">

        <div class="mt-1">
            <h1>Бэкапы <span class="badge badge-warning">beta</span></h1>
        </div>

        <div class="mt-1 text-sm-right">
            <a href="{{ action('BackupController@create')}}" class="btn btn-light" target="_blank">Создать бэкап</a>
        </div>

        <div class="mt-2">
            <table class="table table-striped dataTable">
                <thead>
                <tr>
                    <th>Путь</th>
                    <th>Имя</th>
                    <th>Размер</th>
                    <th>Создан</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>

                @for($i = 0; $i < count($backups); $i++)
                    <tr>
                        <td>{{ $backups[$i]['file_path'] }}</td>
                        <td>{{ $backups[$i]['file_name'] }}</td>
                        <td>{{ $backups[$i]['file_size']  }}</td>
                        <td>{{ $backups[$i]['last_modified'] }}</td>
                        <td>
                            <a href="{{ action('BackupController@download', ['file_name' => $backups[$i]['file_name']]) }}" target="_blank" class="btn btn-outline-primary">Загрузить</a>
                            <button class="btn btn-outline-danger backup-delete__tag">Удалить</button>
                        </td>
                    </tr>

                @endfor

                </tbody>
            </table>
        </div>

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