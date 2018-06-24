@extends('layouts.admin-layout')
@section('title', 'Список сервисов')

@php
/** @var App\Models\ExternalService[] $externalServices */
$externalServicesCount = count($externalServices);
@endphp

@section('content')

    <div class="container">
        <div class="row mt-1 mb-1">

            <div class="col-sm-6">
                <h1>Внешние сервисы</h1>
                <p>Сервисы и сайты, которые могут создавать аккаунты HABB ID в нашей базе данных</p>
            </div>

            <div class="col-sm-6 text-sm-right">
                <a href="{{ url('admin/external_services/create')}}" class="btn btn-light">Создать запись</a>
            </div>
        </div>
        <table class="table table-striped dataTable__tag">
            <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Уникальный ключ</th>
                <th>Кол-во аккаунтов</th>
                <th>Дата обновления</th>
                <th>Дата создания</th>
            </tr>
            </thead>
            <tbody>
            @for($i = 0; $i < $externalServicesCount; $i++)
                <tr>
                    <td>{{ $externalServices[$i]->id }}</td>
                    <td><b>{{ link_to_action('ExternalServicesController@show', $externalServices[$i]->title, ['id' => $externalServices[$i]->id]) }}</b></td>
                    <td>{{ $externalServices[$i]->api_key  }}</td>
                    <td>{{ count($externalServices[$i]->gamers)  }}</td>
                    <td>{{ $externalServices[$i]->UpdatedAt()  }}</td>
                    <td>{{ $externalServices[$i]->CreatedAt()  }}</td>

                </tr>

            @endfor

            </tbody>
        </table>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('thirdparty/dataTables/dataTables.min.js') }}"></script>
    <script>
        $(function(){
            $('.dataTable__tag').DataTable();
        });
    </script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('thirdparty/dataTables/dataTables.min.css') }}">
@endsection