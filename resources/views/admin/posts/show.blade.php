
@extends(\App\Helpers\Constants::BackLayoutPath)
@section('title', 'Информация о статье')

@section('content')
    <h1 class="mt-1">Статья "{{ $post->title }}" [ID {{ $post->id }}]</h1>

    <div class="card">
        <div class="card-block">
            <div class="card-text">

                <dl class="row">
                    <dt class="col-sm-2">Заголовок</dt>
                    <dd class="col-sm-10">{{ $post->title }}</dd>

                    <dt class="col-sm-2">Контент</dt>
                    <dd class="col-sm-10">{{ $post->content }}</dd>

                    <dt class="col-sm-2">Просмотры</dt>
                    <dd class="col-sm-10">{{ $post->views }}</dd>

                    <dt class="col-sm-2">Обновлена</dt>
                    <dd class="col-sm-10">{{ $post->updated_at }}</dd>

                    <dt class="col-sm-2">Создана</dt>
                    <dd class="col-sm-10">{{ $post->created_at }}</dd>

                </dl>

            </div>

        </div>
        <div class="card-footer">
            {{ link_to_action('PostController@index', 'В список', null, ['class' => 'btn btn-secondary']) }}
            <div class="float-sm-right">

                {{ link_to_action('PostController@edit', 'Редактировать', ['id' => $post->id], ['class' => 'btn btn-primary']) }}
                {{ link_to_action('PostController@destroy', 'Удалить', ['id' => $post->id], ['class' => 'btn btn-outline-danger']) }}
            </div>
        </div>
    </div>

@endsection