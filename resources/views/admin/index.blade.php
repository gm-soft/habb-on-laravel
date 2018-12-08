
@extends('layouts.admin-layout')

@php
    /** @var App\ViewModels\Back\AdminHomePageViewModel $model */

@endphp

@section('content')
    <div class="container-fluid">
        <h1 class="mt-3">Графики и вот это вот все</h1>

        <div class="mt-3">

            <div class="row">

                <div class="col-md-3 h-100">

                    <div class="card">
                        <div class="card-header">
                            HABB-аккаунты
                        </div>
                        <div class="card-body">
                            <div class="card-text">
                                <ul>
                                    <li>Активных: <span class="float-right">{{ $model->active_habb_accounts_count }}</span></li>
                                    <li>Неактивных: <span class="float-right">{{ $model->non_action_habb_accounts_count }}</span></li>
                                    <li>Всего: <span class="float-right">{{ $model->accounts_count }}</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ action('GamerController@index') }}" class="btn btn-outline-info card-link">Открыть список аккаунтов</a>
                        </div>
                    </div>

                    <div class="mt-2 card">
                        <div class="card-header">
                            Новости
                        </div>
                        <div class="card-body">
                            <div class="card-text">
                                <div>Всего: {{ $model->posts_count }}</div>

                                <div class="mt-2">
                                    <span>Самые популярные новости</span>
                                    <ul>
                                        @foreach($model->top_viewed_posts as $post)

                                            <li>
                                                <a href="{{ action('PostController@show', ['id' => $post->id ]) }}" class="text-dark">
                                                    #{{ $post->title }}<span class="float-right">{{ $post->views }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ action('PostController@index') }}" class="btn btn-outline-info card-link">Открыть новости</a>
                        </div>
                    </div>

                </div>

                <div class="col-md-9">
                    <div>Динамика регистраций HABB ID за последние 30 дней</div>
                    <div class="h-100">

                        <div class="chart__tag h-100"></div>
                    </div>

                </div>

            </div>

        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('/thirdparty/chartist/chartist.min.css') }}">
@endsection

@section('scripts')

    <script src="{{ asset('/thirdparty/chartist/chartist.min.js') }}"></script>
    <script>

        $(function(){

            var data = {
                // A labels array that can contain any sort of values
                labels: {!! json_encode($model->gamers_by_days_labels) !!},
                // Our series array that contains series objects or in this case series data arrays
                series: [
                    {!! json_encode($model->gamers_by_days_values) !!}
                ]
            };

            var chart = new Chartist.Line('.chart__tag', data, {
                low: 0,
                showArea: true
            });

            chart.on('created', function(){
                var points = $('.ct-point');

                for (var i = 0; i < points.length; i++){
                    var thisPoint = $(points[i]);

                    var value = thisPoint.attr('ct:value');
                    thisPoint
                        .attr('data-toggle', 'tooltip')
                        .attr('data-placement', 'top')
                        .attr('title', value);
                }

                $('[data-toggle="tooltip"]').tooltip();
            });



        });

    </script>

@endsection