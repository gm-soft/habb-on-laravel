<div class="col-md-4 p-1">
    <div class="card h-100 habb-post-announce-card">

        <img class="card-img-top w-100" src="{{ asset($post->announce_image) }}" alt="">
        <div class="card-body">
            <h5 class="card-title">
                {{ $post->title }}
            </h5>

            <a href="{{ url('news/'.$post->id) }}" class="card-link">Перейти</a>
        </div>

        <div class="card-footer">
            <small class="text-muted">Просмотров: {{ $post->views }}</small>
        </div>
    </div>
</div>