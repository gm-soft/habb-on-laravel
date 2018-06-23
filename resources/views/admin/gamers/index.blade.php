
@extends('layouts.admin-layout')
@section('title', 'Список игроков')
@php
$count = count($gamers);

@endphp
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
                    <th>VK страница</th>
                    <th>Игра</th>
                    <th>Сторонний источник</th>
                </tr>
                </thead>
                <tbody>
                @for($i=0;$i<$count;$i++)
                    @php
                        $gamer = $gamers[$i];
                        $name = $gamer->name." ".$gamer->last_name

                @endphp
                <tr>
                    <td>{{ $gamer->id }}</td>
                    <td><b>{{ link_to_action('GamerController@show', $name, ['id' => $gamer->id]) }}</b></td>
                    <td>{{ $gamer->phone  }}</td>
                    <td><a href="{{ $gamer->vk_page  }}">{{ $gamer->vk_page  }}</a></td>
                    <td>{{ $gamer->primary_game  }}</td>
                    <td>
                        @if(is_null($gamer->external_service_id))
                            Сайт HABB
                        @else
                            @php($externalService = $gamer->externalService)
                            {{ link_to_action('ExternalServicesController@show', $externalService->title, ['id' => $externalService->id]) }}
                        @endif
                    </td>
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