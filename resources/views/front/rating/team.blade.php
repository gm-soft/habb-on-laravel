
@extends(\App\Helpers\Constants::FrontLayoutPath)
@section('title', 'Рейтинг команд')

@section('content')
    <h1 class="mt-1">Топ команд <span class="float-sm-right">{{ $game }}</span></h1>
    <div class="mt-1 mb-1 float-sm-right">
        <div class="btn-group" role="group" aria-label="Игры">
            <a href="{{ url('rating/teams', ['game' => 'cs:go']) }}" class="btn btn-secondary">CS:GO</a>
            <a href="{{ url('rating/teams', ['game' => 'dota']) }}" class="btn btn-secondary">Dota 2</a>
            <a href="{{ url('rating/teams', ['game' => 'hearthstone']) }}" class="btn btn-secondary">Hearthstone</a>
        </div>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>Позиция</th>
            <th>Команда</th>
            <th>Город</th>
            <th>Очки</th>
            <th>Капитан</th>
            <th>Игрок</th>
            <th>Игрок</th>
            <th>Игрок</th>
            <th>Игрок</th>
        </tr>
        </thead>
        <tbody>
        {{-- Выводим список команд, у которых очков больше указанного значения --}}
        @php($position = 0)
        @for($i = 0; $i < count($greater); $i++)

            @if ($i == 0)
                {!! \App\Helpers\HtmlWrappers::AddRatingHeaderRow("Premium", 9) !!}
            @endif
            @if ($i == 5)
                {!! \App\Helpers\HtmlWrappers::AddRatingHeaderRow("Дивизион 1", 9) !!}
            @endif
            @if ($i == 25)
                {!! \App\Helpers\HtmlWrappers::AddRatingHeaderRow("Дивизион 2", 9) !!}
            @endif
            @if ($i == 45)
                {!! \App\Helpers\HtmlWrappers::AddRatingHeaderRow("Дивизион 3", 9) !!}

            @endif
            @if ($i == 65)
                {!! \App\Helpers\HtmlWrappers::AddRatingHeaderRow("Дивизион 4", 9) !!}
            @endif
            @if ($i == 85)
                {!! \App\Helpers\HtmlWrappers::AddRatingHeaderRow("Дивизион 5", 9) !!}
            @endif

            @php
                $team = $greater[$i];
                $position++;
                $name = "<b>".$team->name."</b><br>"."ID ".$team->id;
                $score = $team->total_value. " (". \App\Helpers\HtmlWrappers::WrapScoreChange($team->total_change) .")";

                $teamGamers = $gamers[$team->name];
            @endphp
            <tr>
                <td>{{ $position }}</td>
                <td>{!! $name !!}</td>
                <td>{{ $team->city }}</td>
                <td>{!! $score !!}</td>


                @for($j = 0; $j < 5; $j++)
                    @php
                        if (!isset($teamGamers[$j]) || is_null($teamGamers[$j])) {
                            $display = "Без игрока";
                        }
                        else {
                            $teamGamer = $teamGamers[$j];
                            $display = "<b>".$teamGamer->name. " ". $teamGamer->last_name. "</b><br>";
                            $display .= "ID ".$teamGamer->id.". Рейт ".$teamGamer->total_value;
                        }
                    @endphp

                    <td>{!! $display !!}</td>
                @endfor

            </tr>
        @endfor


        {{-- Cписок участников, у которых очков меньше указанного значения --}}
        @for($i = 0; $i < count($bellow); $i++)

            @if ($i == 0)
                {!! \App\Helpers\HtmlWrappers::AddRatingHeaderRow("Bellow the line", 9) !!}
            @endif

            @php
                $team = $bellow[$i];
                $position++;
                $name = "ID ".$team->id." <b>".$team->name."</b>";
                $score = $team->total_value. " (". \App\Helpers\HtmlWrappers::WrapScoreChange($team->total_change) .")";
                $teamGamers = $gamers[$team->name];

            @endphp
            <tr>
                <td>{{ $position }}</td>
                <td>{!! $name !!}</td>
                <td>{{ $team->city }}</td>
                <td>{!! $score !!}</td>

                @for($j = 0; $j < 5; $j++)
                    @php
                        if (!isset($teamGamers[$j])) {
                            $display = "Без игрока";
                        }
                        else {
                            $teamGamer = $teamGamers[$j];
                            $display = "<b>".$teamGamer->name. " ". $teamGamer->last_name. "</b><br>";
                            $display .= "ID ".$teamGamer->id.". Рейт ".$teamGamer->total_value;
                        }
                    @endphp

                    <td>{!! $display !!}</td>
                @endfor
            </tr>
        @endfor
        </tbody>
    </table>


@endsection