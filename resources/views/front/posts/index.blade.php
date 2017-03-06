
@extends(\App\Helpers\Constants::FrontLayoutPath)
@section('title', 'Новости портала')

@section('content')
    <h1 class="mt-1">Новости</h1>
    <hr>

    @foreach($posts as $post)

        <div class="mt-1 habb-post">
            <h3>{{ $post->title }}</h3>
            <p>
                {!! $post->getContentShortly(400) !!}
            </p>
            <div class="mt-1 row">
                <div class="col-sm-6">
                    {{ $post->updated_at }}. Просмотров: {{ $post->views }}
                </div>
                <div class="col-sm-6 text-sm-right">
                    {{ link_to_action('FrontController@openPost', 'Подробнее', ['id'=>$post->id], ['class' => 'btn btn-outline-primary']) }}
                </div>
            </div>
            <hr>
        </div>


    @endforeach

@endsection