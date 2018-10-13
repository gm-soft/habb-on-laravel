@foreach($hashtags as $hashtag)
    <a href="{{ action('HomeController@news', [ 'hashtag' => $hashtag ]) }}" class="" target="_blank">#{{ $hashtag }}</a>
@endforeach