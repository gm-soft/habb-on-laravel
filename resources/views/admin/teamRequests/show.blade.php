
@extends('layouts.admin-layout')
@section('title', 'Информация об команде')

@section('content')
    <div class="container">
        <div class="mt-1">
            <h1>Заявка №{{ $instance->id }}</h1>
            <p class="text-muted">Создание: {{ $instance->created_at }}. Обновление: {{ $instance->updated_at }}</p>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <dl>
                    <dt>Название</dt>       <dd>{{ $instance->name }}</dd>
                    <dt>Город</dt>          <dd>{{ $instance->city }}</dd>
                    <dt>Запросивший</dt>    <dd>{{ $instance->requester_name }}</dd>
                    <dt>Телефон</dt>        <dd>{{ $instance->requester_phone }}</dd>
                    <dt>Email</dt>          <dd>{{ $instance->requester_email }}</dd>
                    <dt>Комментарий менеджера</dt><dd>{{ $instance->comment }}</dd>
                </dl>

                <hr>
                {{ link_to_action('TeamCreateRequestController@index', 'В список', [], ['class' => 'btn btn-secondary']) }}
                <span class="float-sm-right">
                    {{ link_to_action('TeamCreateRequestController@edit', 'Редактировать', ['id' => $instance->id], ['class' => 'btn btn-primary']) }}
                    {{ link_to_action('TeamCreateRequestController@destroy', 'Удалить', ['id' => $instance->id], ['class' => 'btn btn-outline-danger']) }}
                </span>

            </div>
            <div class="col-sm-6">
                <table class="table table-striped table-small">
                    <thead>
                    <tr>
                        <th>HABB ID</th>
                        <th>Имя</th>
                        <th>Роль</th>
                        <th>Найденный аккаунт</th>
                    </tr>
                    </thead>
                    <tbody>
                    @for($i = 0; $i < count($instance->participant_ids); $i++)
                        <tr>
                            <td>{{ $instance->participant_ids[$i] }}</td>
                            <td>{{ $instance->participant_names[$i] }}</td>
                            <td>{{ $instance->participant_roles[$i] }}</td>
                            <td>
                                @if($gamers[$i])
                                    @php($name = $gamers[$i]->name. " " . $gamers[$i]->last_name)
                                    {{ link_to_action('GamerController@show', $name, ['id'=>$gamers[$i]->id]) }}

                                @else
                                    <b>Гемеймера с указанным ID не найдено</b>
                                @endif
                            </td>

                        </tr>
                    @endfor
                    </tbody>
                </table>

            </div>

        </div>
        <div class="mt-1">

        </div>
    </div>

@endsection