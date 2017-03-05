
@extends(\App\Helpers\Constants::BackLayoutPath)
@section('title', 'Информация об игроке')

@section('content')
    <h1 class="mt-1">Игрок {{ $gamer->name }} {{ $gamer->last_name }} [ID {{ $gamer->id }}]</h1>

    <div class="card">
        <div class="card-block">
            <h3 class="card-title">Информация</h3>
            <div class="card-text">

                <div class="row">

                    <div class="col-sm-6">
                        <dl class="row">
                            <dt class="col-sm-3">Возраст</dt><dd class="col-sm-9">{{ $gamer->getGamerAge() }} лет  ({{ $gamer->getBirthday() }})</dd>
                            <dt class="col-sm-3">Телефон</dt><dd class="col-sm-9">{{ $gamer->phone }}</dd>
                            <dt class="col-sm-3">Email</dt><dd class="col-sm-9">{{ $gamer->email }}</dd>
                            <dt class="col-sm-3">Страница VK</dt><dd class="col-sm-9">{{ $gamer->vk_page }}</dd>
                            <dt class="col-sm-3">Город</dt><dd class="col-sm-9">{{ $gamer->city }}</dd>
                            <dt class="col-sm-3">Статус</dt><dd class="col-sm-9">{{ $gamer->status }}</dd>
                            <dt class="col-sm-3">Учреждение</dt><dd class="col-sm-9">{{ $gamer->institution }}</dd>

                        </dl>
                    </div>

                    <div class="col-sm-6">
                        <dl class="row">
                            <dt class="col-sm-3">Лид</dt><dd class="col-sm-9">{{ $gamer->lead_id }}</dd>
                            <dt class="col-sm-3">Комментарий</dt><dd class="col-sm-9">{{ $gamer->comment }}</dd>

                            <dt class="col-sm-3">Создан</dt><dd class="col-sm-9">{{ $gamer->created_at }}</dd>
                            <dt class="col-sm-3">Обновлен</dt><dd class="col-sm-9">{{ $gamer->updated_at }}</dd>
                        </dl>
                    </div>

                </div>

            </div>
            <div class="card-footer">
                {{ link_to_action('GamerController@index', 'В список', null, ['class' => 'btn btn-secondary']) }}
                <div class="float-sm-right">

                    {{ link_to_action('GamerController@edit', 'Редактировать', ['id' => $post->id], ['class' => 'btn btn-primary']) }}
                    {{ link_to_action('GamerController@destroy', 'Удалить', ['id' => $post->id], ['class' => 'btn btn-outline-danger']) }}
                </div>
            </div>
        </div>
    </div>

    @include('admin/gamers/score-table')
@endsection