
@extends(\App\Helpers\Constants::BackLayoutPath)
@section('title', 'Создание поста')

@section('content')
    <h1 class="mt-1">Создать новую статью</h1>
    <div class="">
        {!! Form::open(array('action' => array('PostController@store'))) !!}
            @include('admin/posts/form')
        {!! Form::close() !!}
    </div>


@endsection

@section('scripts')
@endsection