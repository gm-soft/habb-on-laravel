
@extends('layouts.front-layout')
@section('title', 'Рейтинг команд')

@php
    /** @var \App\ViewModels\Front\TeamRatingViewModel $model */
@endphp

@section('content')
    <div class="container mt-2">
        <h1 class="uk-margin">
            Топ команд <span class="float-md-right">{{ $model->game }}</span>
        </h1>

        <div class="my-2 float-md-right">
            <div class="btn-group" role="group">
                <a href="{{ url('rating/teams', ['game' => 'cs:go']) }}" class="btn btn-light">CS:GO</a>
                <a href="{{ url('rating/teams', ['game' => 'dota']) }}" class="btn btn-light">Dota 2</a>
                <a href="{{ url('rating/teams', ['game' => 'hearthstone']) }}" class="btn btn-light">Hearthstone</a>
            </div>
        </div>

        <table class="table table-striped">
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
            @for($i = 0; $i < count($model->greater); $i++)

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
                    $team = $model->greater[$i];
                    $position++;
                    $name = "<b>".$team->name."</b><br>"."ID ".$team->id;
                    $score = $team->total_value. " (". \App\Helpers\HtmlWrappers::WrapScoreChange($team->total_change) .")";

                    $teamGamers = $model->gamers[$team->name];
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
            @for($i = 0; $i < count($model->bellow); $i++)

                @if ($i == 0)
                    {!! \App\Helpers\HtmlWrappers::AddRatingHeaderRow("Below the line", 9) !!}
                @endif

                @php
                    $team = $model->bellow[$i];
                    $position++;
                    $name = "ID ".$team->id." <b>".$team->name."</b>";
                    $score = $team->total_value. " (". \App\Helpers\HtmlWrappers::WrapScoreChange($team->total_change) .")";
                    $teamGamers = $model->gamers[$team->name];

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

        <div class="uk-margin uk-text-center">
            <a href="#" uk-totop uk-scroll class="uk-button uk-button-default">Наверх</a>
        </div>
    </div>


@endsection