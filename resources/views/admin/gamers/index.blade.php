
@extends('layouts.admin-layout')
@section('title', 'Список игроков')

    @section('content')

        <div class="container">
            <div class="row mt-1 mb-1">

                <div class="col-sm-6">
                    <h1>Игроки</h1>
                </div>

                <div class="col-sm-6 text-sm-right">
                    <a href="{{url('admin/gamers/create')}}" class="btn btn-light">Создать запись</a>
                </div>
            </div>
            <table class="table table-striped dataTable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Телефон</th>
                    <th>VK страница</th>
                    <th>Игра</th>
                    <th>Сторонний источник</th>
                </tr>
                </thead>
        </table>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('thirdparty/dataTables/dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.dataTable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax":{
                    "url": "{{ action('GamerController@gamerReportForDatatable') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data":{ _token: "{{ csrf_token() }}"}
                },
                "columns": [
                    { "data": "id" },
                    { "data": "name" },
                    { "data": "phone" },
                    { "data": "vk_page" },
                    { "data": "primary_game" },
                    { "data": "source" }
                ]

            });
        });
    </script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('thirdparty/dataTables/dataTables.min.css') }}">
@endsection