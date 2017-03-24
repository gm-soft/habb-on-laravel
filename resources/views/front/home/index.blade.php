
@extends('layouts.front-layout')

@section('content')

    <div class="jumbotron-fluid uk-background-fixed jumbotron-background uk-background-top-center background-gray uk-background-blend-overlay uk-background-cover">
        <div class="uk-container uk-text-center py-6-3">
            <h1 class="display-1">HABB</h1>
            <p class="uk-text-lead">Сообщество геймеров Казахстана</p>

        </div>
    </div>

    <div class="uk-section">
        <div class="uk-container">
            Technically imitate a starshipе. None of these metamorphosis will be lost in shields like minds in powerdrains.
            Technically imitate a starshipе. None of these metamorphosis will be lost in shields like minds in powerdrains.
            Technically imitate a starshipе. None of these metamorphosis will be lost in shields like minds in powerdrains.
            Technically imitate a starshipе. None of these metamorphosis will be lost in shields like minds in powerdrains.
            Technically imitate a starshipе. None of these metamorphosis will be lost in shields like minds in powerdrains.
            Technically imitate a starshipе. None of these metamorphosis will be lost in shields like minds in powerdrains.
            Technically imitate a starshipе. None of these metamorphosis will be lost in shields like minds in powerdrains.
        </div>
    </div>

    <div class="uk-section">
        <div class="uk-container">
            <div class="uk-text-center" uk-grid>

                @for($i = 0; $i < 3; $i++)

                    <div class="uk-width-1-3">
                        <div class="uk-card uk-card-default uk-card-hover">
                            <div class="uk-card-media-top uk-cover-container uk-height-medium">
                                <img src="{{ url('images/cup.jpg') }}" alt="" uk-cover>
                            </div>
                            <div class="uk-card-body uk-text-left">
                                <h3 class="uk-card-title">Товар #{{ $i }}</h3>
                                <p class="">
                                    Why does the mermaid walk? Seaweed chili has to have a thin, diced chicken breasts component.
                                </p>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>

    <div class="uk-section">
        <div class="uk-container">
            Technically imitate a starshipе. None of these metamorphosis will be lost in shields like minds in powerdrains.
            Technically imitate a starshipе. None of these metamorphosis will be lost in shields like minds in powerdrains.
            Technically imitate a starshipе. None of these metamorphosis will be lost in shields like minds in powerdrains.
            Technically imitate a starshipе. None of these metamorphosis will be lost in shields like minds in powerdrains.
            Technically imitate a starshipе. None of these metamorphosis will be lost in shields like minds in powerdrains.
            Technically imitate a starshipе. None of these metamorphosis will be lost in shields like minds in powerdrains.
            Technically imitate a starshipе. None of these metamorphosis will be lost in shields like minds in powerdrains.
        </div>
    </div>




@endsection