
@extends('layouts.admin-layout')
@section('title', 'Команды Habb')

@section('content')
    <div class="container">
        <h1 class="mt-1">Команды</h1>
        <div class="mb-1 text-sm-right">
            <a href="{{ action('TeamController@create') }}" class="btn btn-light">Создать команду</a>
        </div>
        <table class="table table-striped dataTable">
            <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Капитан</th>
                <th>Участие в турнирах</th>
                <th>Создана</th>
            </tr>
            </thead>
            <tbody>
            @for($i = 0; $i < count($teams); $i++)
                @php
                    $team = $teams[$i];
                    $captain = $team->captain;

                @endphp
                <tr>
                    <td>{{ $teams[$i]->id }}</td>
                    <td><b>{{ link_to_action('TeamController@show', $team->name, ['id' => $team->id]) }}</b></td>
                    <td>{{ link_to_action('GamerController@show', $captain->getFullName(), ['id' => $captain->id]) }}</td>
                    <td>{{ $team->tournamentsThatTakePart()->count() }}</td>
                    <td>{{ $team->CreatedAt()  }}</td>
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