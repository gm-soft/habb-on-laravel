
@extends(\App\Helpers\Constants::BackLayoutPath)
@section('title', 'Информация об команде')

@section('content')
    <h1 class="mt-2">Игрок {{ $team->name }} [ID {{ $team->id }}]</h1>

    <div class="mt-1 card">
        <div class="card-block">
            <div class="card-text">

                <div class="row">

                    <div class="col-sm-6">
                        <dl class="row">
                            <dt class="col-sm-3">Участники</dt><dd class="col-sm-9">{{ $team->getGamerIdsAsString() }}</dd>
                            <dt class="col-sm-3">Город</dt><dd class="col-sm-9">{{ $team->city }}</dd>
                            <dt class="col-sm-3">Комментарий</dt><dd class="col-sm-9">{{ $team->comment }}</dd>
                            <dt class="col-sm-3">Создан</dt><dd class="col-sm-9">{{ $team->created_at }}</dd>
                            <dt class="col-sm-3">Обновлен</dt><dd class="col-sm-9">{{ $team->updated_at }}</dd>
                        </dl>
                    </div>

                    <div class="col-sm-6">
                        @include('admin/teams/team-participants')
                    </div>

                </div>

            </div>
        </div>
        <div class="card-footer">
            {{ link_to_action('TeamController@index', 'В список', [], ['class' => 'btn btn-secondary']) }}
            <div class="float-sm-right">

                {{ link_to_action('TeamController@edit', 'Редактировать', ['id' => $team->id], ['class' => 'btn btn-primary']) }}
                {{ link_to_action('TeamController@destroy', 'Удалить', ['id' => $team->id], ['class' => 'btn btn-outline-danger']) }}
            </div>
        </div>
    </div>

    <div class="mt-1">
        @include('admin/teams/score-table')
    </div>

@endsection