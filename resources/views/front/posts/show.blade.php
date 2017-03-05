
@extends(\App\Helpers\Constants::FrontLayoutPath)
@section('title', 'Информация о статье')

@section('content')
    <h1 class="mt-1">{{ $post->title }}</h1>

    <div class="mt-2">
        {{ $post->content }}
    </div>
    <hr>
    <div class="mt-2 row">
        <div class="col-sm-6">
            {{ link_to_action('FrontController@showAllPosts', 'В список новостей', [], ['class' => 'btn btn-secondary']) }}
        </div>
        <div class="col-sm-6">
            <div class="float-sm-right">
                Просмотров: {{ $post->views }}. Публикация: {{ $post->updated_at }}.
            </div>

        </div>

    </div>

@endsection