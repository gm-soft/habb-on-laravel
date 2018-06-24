
@extends('layouts.admin-layout')
@section('title', 'Команды Habb')

@section('content')
    <div class="container">
        <h1 class="mt-1">Команды</h1>
        <div class="mb-1 text-sm-right">
            <a href="{{url('admin/teams/create')}}" class="btn btn-light">Создать запись</a>
        </div>
        <table class="table table-striped dataTable">
            <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Капитан</th>
                <th>Игрок</th>
                <th>Игрок</th>
                <th>Игрок</th>
                <th>Игрок</th>
            </tr>
            </thead>
            <tbody>
            @for($i=0;$i<count($teams);$i++)
                @php
                    $gamersArray = $gamers[$teams[$i]->name];
                    $cap = isset($gamersArray[0]) ? $gamersArray[0]->getFullName() : 'Без игрока';
                    $g1 = isset($gamersArray[1]) ? $gamersArray[1]->getFullName() : 'Без игрока';
                    $g2 = isset($gamersArray[2]) ? $gamersArray[2]->getFullName() : 'Без игрока';
                    $g3 = isset($gamersArray[3]) ? $gamersArray[3]->getFullName() : 'Без игрока';
                    $g4 = isset($gamersArray[4]) ? $gamersArray[4]->getFullName() : 'Без игрока';

                @endphp
                <tr>
                    <td>{{ $teams[$i]->id }}</td>
                    <td><b>{{ link_to_action('TeamController@show', $teams[$i]->name, ['id' => $teams[$i]->id]) }}</b></td>
                    <td><i>{{ $cap }}</i></td>
                    <td>{{ $g1 }}</td>
                    <td>{{ $g2  }}</td>
                    <td>{{ $g3  }}</td>
                    <td>{{ $g4  }}</td>
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