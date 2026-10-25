@if ($terms)
    <div class="post-terms text-sm mb-2">
        @foreach ($terms as $term)
            <a href="{!! $term['link'] !!}" class="post-term hover:underline">{!! $term['name'] !!}</a>

            @if (!$loop->last)
                ,
            @endif
        @endforeach
    </div>
@endif
