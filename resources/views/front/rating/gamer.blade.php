
@extends('layouts.front-layout')
@section('title', 'Рейтинг игроков')

    @php
        /** @var \App\ViewModels\Front\RatingViewModelBase $model */
    @endphp
@section('content')
    <div class="container mt-2">
        <h1 class="my-1">
            Топ игроков <span class="float-md-right">{{ $model->game }}</span>
        </h1>

        <div class="my-2 float-md-right">
            <div class="btn-group" role="group">
                <a href="{{ url('rating/gamers', ['game' => 'cs:go']) }}" class="btn btn-light">CS:GO</a>
                <a href="{{ url('rating/gamers', ['game' => 'dota']) }}" class="btn btn-light">Dota 2</a>
                <a href="{{ url('rating/gamers', ['game' => 'hearthstone']) }}" class="btn btn-light">Hearthstone</a>
            </div>
        </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Позиция</th>
                <th>Игрок</th>
                <th>Город</th>
                <th>Очки</th>
            </tr>
            </thead>
            <tbody>
            {{-- Выводим список участников, у которых очков больше указанного значения --}}
            @php($position = 0)
            @for($i = 0; $i < count($model->greater); $i++)

                @if ($i == 0)
                    {!! \App\Helpers\HtmlWrappers::AddRatingHeaderRow("Premium") !!}
                @endif
                @if ($i == 5)
                    {!! \App\Helpers\HtmlWrappers::AddRatingHeaderRow("Дивизион 1") !!}
                @endif
                @if ($i == 25)
                    {!! \App\Helpers\HtmlWrappers::AddRatingHeaderRow("Дивизион 2") !!}
                @endif
                @if ($i == 45)
                    {!! \App\Helpers\HtmlWrappers::AddRatingHeaderRow("Дивизион 3") !!}

                @endif
                @if ($i == 65)
                    {!! \App\Helpers\HtmlWrappers::AddRatingHeaderRow("Дивизион 4") !!}
                @endif
                @if ($i == 85)
                    {!! \App\Helpers\HtmlWrappers::AddRatingHeaderRow("Дивизион 5") !!}
                @endif

                @php
                    $row = $model->greater[$i];
                    $position++;
                    $name = "ID ".$row->id." <b>".$row->name." ".$row->last_name."</b>";
                    $score = $row->total_value. " (". \App\Helpers\HtmlWrappers::WrapScoreChange($row->total_change) .")";

                @endphp
                <tr>
                    <td>{{ $position }}</td>
                    <td>{!! $name !!}</td>
                    <td>{{ $row->city }}</td>
                    <td>{!! $score !!}</td>
                </tr>
            @endfor
            {{-- Cписок участников, у которых очков меньше указанного значения --}}
            @for($i = 0; $i < count($model->bellow); $i++)

                @if ($i == 0)
                    {!! \App\Helpers\HtmlWrappers::AddRatingHeaderRow("Below the line") !!}
                @endif

                @php
                    $row = $model->bellow[$i];
                    $position++;
                    $name = "ID ".$row->id." <b>".$row->name." ".$row->last_name."</b>";
                    $score = $row->total_value. " (". \App\Helpers\HtmlWrappers::WrapScoreChange($row->total_change) .")";

                @endphp
                <tr>
                    <td>{{ $position }}</td>
                    <td>{!! $name !!}</td>
                    <td>{{ $row->city }}</td>
                    <td>{!! $score !!}</td>
                </tr>
            @endfor
            </tbody>
        </table>
    </div>

@endsection