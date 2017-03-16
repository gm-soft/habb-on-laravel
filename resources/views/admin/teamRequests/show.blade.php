
@extends('layouts.admin-layout')
@section('title', 'Заявка на команду')

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
                    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteDialog">Удалить</button>
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

    <div class="modal fade" id="deleteDialog" tabindex="-1" role="dialog" aria-labelledby="deleteDialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Удаление объекта</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['method' =>'delete', 'action' => ['TeamCreateRequestController@destroy', $instance->id]]) !!}
                    <div class="modal-body">
                        Вы уверены, что хотите удалить заявку на создание команды #{{ $instance->id }}?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-outline-danger">Удалить</button>
                    </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>

@endsection