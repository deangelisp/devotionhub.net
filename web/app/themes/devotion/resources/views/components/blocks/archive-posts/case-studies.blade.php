<div class="section-page">

    @if ($content)
        <div class="entry-content container mb-10">{!! $content !!}</div>
    @endif

    @include('partials.post.loop', [
        'type' => 'post',
        'query' => $query,
    ])
</div>
