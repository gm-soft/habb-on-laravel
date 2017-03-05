
@extends(\App\Helpers\Constants::FrontLayoutPath)
@section('title', 'Новости портала')

@section('content')
    <h1 class="mt-1">Новости</h1>
    <hr>

    <div class="row">
        @foreach($posts as $post)
            <div class="card col-sm-4">
                <div class="card-block">
                    <h4 class="card-title">{{ $post->title }}</h4>
                    <div class="card-text">
                        {{ $post->getContentShortly(50) }}
                        <br>
                        {{ link_to_action('FrontController@openPost', 'Подробнее', ['id'=>$post->id]) }}
                        <hr>
                        {{ $post->updated_at }}. Просмотров: {{ $post->views }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection