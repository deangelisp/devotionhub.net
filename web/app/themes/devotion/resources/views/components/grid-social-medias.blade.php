@if ($socials)
    <nav class="{!! $className !!}">
        @foreach ($socials as $item)
            <a href="{!! $item['url'] !!}" title="{!! $item['media'] !!}" aria-label="{!! $item['media'] !!}"
                target="_blank">
                @svg("images.svg.social-media.{$item['media']}", $iconSize . ' fill-current link-on-hover transition-colors')
            </a>
        @endforeach
    </nav>
@endif
