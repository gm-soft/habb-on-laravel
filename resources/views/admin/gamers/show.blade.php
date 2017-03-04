
@extends(\App\Helpers\Constants::BackLayoutPath)
@section('title', 'Информация об игроке')

@section('content')
    <h1 class="mt-1">Игрок {{ $gamer->name }}</h1>

    Age: {{ $gamer->getGamerAge() }}
    <pre>
        {{ \App\Helpers\VarDumper::dump($gamer) }}
        <hr>
        {{ \App\Helpers\VarDumper::dump($gamer->scores()) }}

    </pre>
@endsection