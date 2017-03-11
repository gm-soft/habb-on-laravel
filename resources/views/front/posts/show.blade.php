
@extends(\App\Helpers\Constants::FrontLayoutPath)
@section('title', 'Информация о статье')

@section('content')
    <h1 class="mt-1">{{ $post->title }}</h1>

    <div class="mt-1">
        {!! $post->content  !!}
    </div>
    <hr>
    <div class="mt-2 row">
        <a href="{{ url('news') }}" class="btn btn-secondary"><i class="fa fa-chevron-left" aria-hidden="true"></i> В список новостей</a>

        <span class="float-sm-right">
            <i>Просмотров: {{ $post->views }}. Публикация: {{ $post->UpdatedAt() }}</i>
        </span>

    </div>

@endsection