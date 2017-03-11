
@extends(\App\Helpers\Constants::FrontLayoutPath)
@section('title', 'Рейтинг игроков')

@section('content')
    <h1 class="mt-1">Рейтинг игроков</h1>
    <hr>

    <pre>{{ \App\Helpers\VarDumper::dump($rating) }}</pre>


@endsection