<div class="card card--post">
    <figure class="radius overflow-hidden relative  mb-2 lg:mb-4 aspect-video thumbnail-styled">
        {!! $thumbnail !!}
        <a href="{!! $link !!}" class="absolute inset-0 z-10" aria-label="{!! $title !!}">
            <span class="sr-only">{!! $title !!}</span>
        </a>
    </figure>

    <x-terms-list :terms="$categories" />

    <h3 class="text-xl lg:text-2xl">
        <a href="{!! $link !!}" class="hover:underline">{!! $title !!}</a>
    </h3>
    @if ($excerpt)
        <p class="text-dark-tone">{!! $excerpt !!}</p>
    @endif
</div>
