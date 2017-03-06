
@extends(\App\Helpers\Constants::BackLayoutPath)
@section('title', 'Информация о статье')

@section('content')
    <h1 class="mt-2">Статья "{{ $post->title }}" [ID {{ $post->id }}]</h1>

    <div class="mt-2">
        {!! $post->content !!}
    </div>
    <hr>
    <div class="">
        <div class="row">
            <div class="col-sm-3">
                Просмотры: {{ $post->views }}
            </div>

            <div class="col-sm-9 text-sm-right">
                Создана: {{ $post->created_at }}. Обновлена: {{ $post->created_at }}
            </div>

        </div>
    </div>
    <div class="mt-1">
        <div class="row">
            <div class="col-sm-6">
                {{ link_to_action('PostController@index', 'В список', null, ['class' => 'btn btn-secondary']) }}
            </div>

            <div class="col-sm-6 text-sm-right">
                {{ link_to_action('PostController@edit', 'Редактировать', ['id' => $post->id], ['class' => 'btn btn-primary']) }}
                {{ link_to_action('PostController@destroy', 'Удалить', ['id' => $post->id], ['class' => 'btn btn-outline-danger']) }}
            </div>

        </div>
    </div>

@endsection