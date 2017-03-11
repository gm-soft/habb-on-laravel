
@extends(\App\Helpers\Constants::FrontLayoutPath)
@section('title', 'Рейтинг команд')

@section('content')
    <h1 class="mt-1">Рейтинг команд</h1>
    <hr>
    <pre>{{ \App\Helpers\VarDumper::dump($gamers) }}</pre>
    <pre>{{ \App\Helpers\VarDumper::dump($rating) }}</pre>


@endsection