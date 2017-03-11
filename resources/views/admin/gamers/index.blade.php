
@extends('layouts.admin-layout')
@section('title', 'Список игроков')

@section('content')
    <div class="row mt-2 mb-1">

        <div class="col-sm-6">
            <h1>Игроки</h1>
        </div>

        <div class="col-sm-6 text-sm-right">
            <a href="{{url('admin/gamers/create')}}" class="btn btn-secondary">Создать запись</a>
        </div>
    </div>
    <table class="table table-striped dataTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Телефон</th>
                <th>Email</th>
                <th>VK страница</th>
                <th>Игра</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @for($i=0;$i<count($gamers);$i++)

                <tr>
                    <td>{{ $gamers[$i]->id }}</td>
                    <td>{{ $gamers[$i]->name}} {{$gamers[$i]->last_name}}</td>
                    <td>{{ $gamers[$i]->phone  }}</td>
                    <td>{{ $gamers[$i]->email  }}</td>
                    <td>{{ $gamers[$i]->vk_page  }}</td>
                    <td>{{ $gamers[$i]->primary_game  }}</td>
                    <td>
                        {{ link_to_action('GamerController@show', 'Открыть', ['id' => $gamers[$i]->id]) }}
                        {{ link_to_action('GamerController@edit', 'Редактировать', ['id' => $gamers[$i]->id]) }}
                    </td>
                </tr>

            @endfor

        </tbody>
    </table>

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