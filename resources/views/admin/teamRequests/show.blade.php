
@extends('layouts.admin-layout')
@section('title', 'Заявка на команду')

@section('content')
    <div class="container">
        <div class="mt-1">
            <h1>Заявка №{{ $instance->id }}</h1>
            <span class="text-muted float-sm-left">Создание: {{ $instance->created_at }}. Обновление: {{ $instance->updated_at }}</span>
            <span class="float-sm-right">
                {{ link_to_action('TeamCreateRequestController@index', 'В список', null, ['class' => 'btn btn-secondary']) }}
                {{ link_to_action('TeamCreateRequestController@edit', 'Редактировать', ['id' => $instance->id], ['class' => 'btn btn-secondary']) }}
                <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteDialog">Удалить</button>
            </span>
        </div>

        <div class="row mt-3">
            <div class="col-sm-6">
                <dl class="row">
                    <dt class="col-sm-6">Название</dt>       <dd class="col-sm-6 text-sm-right">{{ $instance->name }}</dd>
                    <dt class="col-sm-6">Город</dt>          <dd class="col-sm-6 text-sm-right">{{ $instance->city }}</dd>
                    <dt class="col-sm-6">Запросивший</dt>    <dd class="col-sm-6 text-sm-right">{{ $instance->requester_name }}</dd>
                    <dt class="col-sm-6">Телефон</dt>        <dd class="col-sm-6 text-sm-right">{{ $instance->requester_phone }}</dd>
                    <dt class="col-sm-6">Email</dt>          <dd class="col-sm-6 text-sm-right">{{ $instance->requester_email }}</dd>
                    <dt class="col-sm-6">Комментарий менеджера</dt><dd class="col-sm-6 text-sm-right">{{ $instance->comment ?? "Нет комментария"  }}</dd>
                </dl>
                <hr>
                <dl class="row">
                    <dt class="col-sm-6">Статус обработки</dt><dd class="col-sm-6 text-sm-right">{{ $instance->request_processed }}</dd>
                    <dt class="col-sm-6">Статус создания команды</dt><dd class="col-sm-6 text-sm-right">{{ $instance->team_created }}</dd>

                    <dt class="col-sm-6">Созданная команда</dt>
                    <dd class="col-sm-6 text-sm-right">
                        @if ($instance->request_processed)
                            {{ link_to_action('TeamController@show', "Команда #". $instance->team_id, ['id'=>$instance->team_id]) }}
                        @else
                            Нет команды
                        @endif
                    </dd>
                </dl>

                <hr>
                @if(!$instance->request_processed == 0)
                    <span class="float-sm-right">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#confirmDialog">Принять</button>
                        <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#denyDialog">Отклонить</button>
                    </span>
                @else
                    <span class="float-sm-left text-muted">
                        Заявка уже обработана
                    </span>
                    <span class="float-sm-right">
                        <button type="button" class="btn btn-success disabled" disabled>Принять</button>
                        <button type="button" class="btn btn-outline-danger disabled" disabled>Отклонить</button>
                    </span>
                @endif


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

    <div class="modal fade" id="confirmDialog" tabindex="-1" role="dialog" aria-labelledby="confirmDialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-success" id="exampleModalLabel">Подтверждение заявки</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['method' =>'post', 'url' => '/admin/requests/confirm']) !!}
                    <div class="modal-body">

                        <dl class="row">
                            <dt class="col-sm-6">Название</dt>       <dd class="col-sm-6 text-sm-right">{{ $instance->name }}</dd>
                            <dt class="col-sm-6">Город</dt>          <dd class="col-sm-6 text-sm-right">{{ $instance->city }}</dd>
                            <dt class="col-sm-6">Участники</dt>      <dd class="col-sm-6 text-sm-right">{{ $instance->getParticipantIdsAsString() }}</dd>
                        </dl>
                        <div class="form-group">
                            {!! Form::hidden('request_id', $instance->id) !!}
                            {!! Form::label('confirm_message', 'Сообщение запросившему (по желанию менеджера)') !!}
                            {!! Form::textarea('confirm_message', null, [
                                'class'=>'form-control', 'maxlength'=>150
                            ]) !!}
                            <small>Сообщение будет прикреплено к электронному письму заявителю. Максимум 300 знаков</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-success">Утвердить</button>
                    </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>

    <div class="modal fade" id="denyDialog" tabindex="-1" role="dialog" aria-labelledby="denyDialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-danger" id="exampleModalLabel">Отклонение заявки</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['method' =>'post', 'url' => '/admin/requests/deny']) !!}
                <div class="modal-body">
                    <span class="h5">Получатель сообщения</span>
                    <dl class="row">
                        <dt class="col-sm-6">Имя</dt>       <dd class="col-sm-6 text-sm-right">{{ $instance->requester_name }}</dd>
                        <dt class="col-sm-6">Телефон</dt>          <dd class="col-sm-6 text-sm-right">{{ $instance->requester_phone }}</dd>
                        <dt class="col-sm-6">Email</dt>      <dd class="col-sm-6 text-sm-right">{{ $instance->requester_email }}</dd>
                    </dl>
                    <div class="form-group">
                        {!! Form::hidden('request_id', $instance->id) !!}
                        {!! Form::label('deny_message', 'Причина отказа в заявке (обязательное поле)') !!}
                        {!! Form::textarea('deny_message', null, [
                            'class'=>'form-control', 'maxlength'=>300, 'required'=>true,
                        ]) !!}
                        <small>Сообщение будет прикреплено к электронному письму заявителю. Максимум 300 знаков</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-danger">Отклонить</button>
                </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>

@endsection