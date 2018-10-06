<div class="col-md-4 px-3">
    <div class="card h-100 habb-post-announce-card">

        <img class="card-img-top w-100" src="{{ asset($post->announce_image) }}" alt="">

        <div class="card-body">
            <div class="card-title">
                <a href="{{ action('HomeController@openPost', ['id' => $post->id]) }}" class="card-link habb-post-link">#{{ $post->title }}</a>
            </div>
        </div>

        <div class="card-footer">
            <small class="text-muted">Просмотров: {{ $post->views }}</small>
        </div>
    </div>
</div>