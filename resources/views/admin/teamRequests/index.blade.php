
@extends('layouts.admin-layout')
@section('title', 'Заявки на создание команды Habb')

@section('content')
    <div class="container">
        <h1 class="mt-1">Заявки на создание команды</h1>
        <div class="mb-1 text-sm-right">
            <a href="{{url('admin/requests/teamCreate/create')}}" class="btn btn-secondary">Создать запись</a>
        </div>
        <table class="table table-striped dataTable">
            <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Город</th>
                <th>Запрашивающий</th>
                <th>Кол-во участников</th>
                <th>Обработано</th>
                <th>Команда создана</th>
            </tr>
            </thead>
            <tbody>
            @for($i=0;$i<count($instances);$i++)
                @php
                    $requesterName = $instances[$i]->requester_name."<br>".
                        $instances[$i]->requester_phone;
                    $partCount = count($instances[$i]->participant_ids);
                @endphp
                <tr>
                    <td>{{ $instances[$i]->id }}</td>
                    <td><b>{{ link_to_action('TeamCreateRequestController@show', $instances[$i]->name, ['id' => $instances[$i]->id]) }}</b></td>
                    <td>{{ $instances[$i]->city }}</td>
                    <td>{!! $requesterName !!}</td>
                    <td>{{ $partCount  }}</td>
                    <td>{{ $instances[$i]->request_processed  }}</td>
                    <td>{{ $instances[$i]->team_created  }}</td>
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