
@extends(\App\Helpers\Constants::FrontLayoutPath)
@section('title', 'Новости портала')

@section('content')

    @foreach($posts as $post)
        <div class="mt-1 habb-post">
            <h1># {{ $post->title }}</h1>
            <p>
                {!! $post->getContentShortly(400) !!}
            </p>
            <div class="mt-1 row">
                <div class="col-sm-6">
                    <i class="fa fa-eye" aria-hidden="true"></i> {{ $post->views }}
                </div>
                <div class="col-sm-6 text-sm-right">
                    {{ link_to_action('FrontController@openPost', 'Подробнее', ['id'=>$post->id], ['class' => 'btn btn-outline-primary']) }}
                </div>
            </div>
            <hr>
        </div>
    @endforeach

@endsection