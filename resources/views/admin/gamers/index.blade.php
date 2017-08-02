
@extends('layouts.admin-layout')
@section('title', 'Список игроков')

@section('content')

    <div class="container">
        <div class="row mt-1 mb-1">

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
            </tr>
            </thead>
            <tbody>
            @for($i=0;$i<count($gamers);$i++)
                @php($name = $gamers[$i]->name." ".$gamers[$i]->last_name)
                <tr>
                    <td>{{ $gamers[$i]->id }}</td>
                    <td><b>{{ link_to_action('GamerController@show', $name, ['id' => $gamers[$i]->id]) }}</b></td>
                    <td>{{ $gamers[$i]->phone  }}</td>
                    <td>{{ $gamers[$i]->email  }}</td>
                    <td><a href="{{ $gamers[$i]->vk_page  }}">{{ $gamers[$i]->vk_page  }}</a></td>
                    <td>{{ $gamers[$i]->primary_game  }}</td>
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