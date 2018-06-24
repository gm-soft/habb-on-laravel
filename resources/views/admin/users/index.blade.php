
@extends('layouts.admin-layout')
@section('title', 'Список зарегистрированных пользователей')

@php
    /** @var \App\User[] $users */
@endphp

@section('content')

    <div class="container">
        <div class="row mt-1 mb-1">

            <div class="col-sm-6">
                <h1>Пользователи системы</h1>
            </div>

            <div class="col-sm-6 text-sm-right">
                <a href="{{url('admin/users/create')}}" class="btn btn-light">Создать запись</a>
            </div>
        </div>
        <table class="table table-striped dataTable">
            <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Аккаунт игрока</th>
            </tr>
            </thead>
            <tbody>

            @for($i=0;$i<count($users);$i++)
                <tr>
                    <td>{{ $users[$i]->id }}</td>
                    <td><b>{{ link_to_action('UserController@show', $users[$i]->email, ['id' => $users[$i]->id]) }}</b></td>
                    <td>{{ $users[$i]->getGamerAccountUrl() ?? "Нет данных" }}</td>
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