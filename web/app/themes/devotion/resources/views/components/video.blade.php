<video @foreach ($settings as $key => $value) 
        {{ $key }}="{{ $value }}" @endforeach
    class="{!! $className !!}">

    <source src="{!! $video !!}" type="{!! $videoType !!}">
    <p>
        Your browser doesn't support HTML video. Here is a
        <a href="{!! $video !!}">link to the video</a> instead.
    </p>
</video>
