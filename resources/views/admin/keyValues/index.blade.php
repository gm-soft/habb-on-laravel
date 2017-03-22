
@extends('layouts.admin-layout')
@section('title', 'Список пар ключ-знчение')

@section('content')
    <div class="container">
        <h1 class="mt-1">Пары ключ-знчение</h1>
        <div class="mb-1 text-sm-right">
            <a href="{{url('admin/keyValues/create')}}" class="btn btn-secondary">Создать запись</a>
        </div>

        <table class="table table-striped dataTable">
            <thead>
            <tr>
                <th>ID</th>
                <th>Ключ</th>
                <th>Значение</th>
            </tr>
            </thead>
            <tbody>
            @for($i=0;$i<count($instances);$i++)
                @php($name = $instances[$i]->key)
                <tr>
                    <td>{{ $instances[$i]->id }}</td>
                    <td>{{ link_to_action('KeyValueController@show', $name, ['id' => $instances[$i]->id]) }}</td>
                    <td>{{ $instances[$i]->getValueShortly()  }}</td>
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