<div id="carouselExampleIndicators" class="carousel slide w-100" data-ride="carousel">
    <ol class="carousel-indicators">

        @for ($index = 0; $index < $model->banners_count; $index++)
            @php
                if ($index == 0)
                    $active = "class=\"active\"";
                else
                    $active = "";
            @endphp

            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}" {{ $active }}></li>
        @endfor

    </ol>
    <div class="carousel-inner">

        @for ($index = 0; $index < $model->banners_count; $index++)

            @php
                if ($index == 0)
                    $active = "active";
                else
                    $active = "";
            @endphp

            <div class="carousel-item {{ $active }}">

                <div class="slider-block slider-bg-grey habb-slider-block habb-slider-block-{{ $index }}">
                    <!--div class="habb-overlay"></div-->

                    <div class="carousel-caption habb-carousel-caption">
                        <h1 class="display-1">{{ $model->banners[$index]->title }}</h1>
                        <p>{{ $model->banners[$index]->subtitle }}</p>
                    </div>
                </div>

            </div>

        @endfor

    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Назад</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Вперед</span>
    </a>
</div>