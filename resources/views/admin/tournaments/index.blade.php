
@extends('layouts.admin-layout')
@section('title', 'Турниры Habb')

@section('content')
    <div class="container">
        <h1 class="mt-1">Турниры</h1>
        <div class="mb-1 text-sm-right">
            <a href="{{url('admin/tournaments/create')}}" class="btn btn-light">Создать запись</a>
        </div>

        <table class="table table-striped dataTable">
            <thead>
            <tr>
                <th>Название</th>
                <th>Тип</th>
                <th>Максимум участников</th>
                <th>Кол-во</th>
                <th>Стартует</th>
                <th>Регистрация до..</th>
            </tr>
            </thead>
            <tbody>
            @for($i=0;$i<count($instances);$i++)
                <tr>
                    <td><b>{{ link_to_action('TournamentController@show', $instances[$i]->name, ['id' => $instances[$i]->id]) }}</b></td>
                    <td>{{ $instances[$i]->tournament_type }}</td>
                    <td>{{ $instances[$i]->participant_max_count }}</td>
                    <td>{{ $instances[$i]->getParticipantCount()  }}</td>
                    <td>{{ $instances[$i]->started_at  }}</td>
                    <td>{{ $instances[$i]->reg_closed_at  }}</td>
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