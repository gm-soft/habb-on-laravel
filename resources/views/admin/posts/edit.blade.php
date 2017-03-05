
@extends(\App\Helpers\Constants::BackLayoutPath)
@section('title', 'Редактирование статьи')

@section('content')
    <h1 class="mt-1">Редактирование статьи {{ $post->title }}</h1>
    <div class="">

        {!! Form::model($post, ['method' => 'PATCH', 'action' => ['PostController@update', $post->id]]) !!}
            @include('admin/posts/form')
        {!! Form::close() !!}

    </div>


@endsection

@section('scripts')
@endsection