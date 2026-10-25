<a href="{!! $url !!}" class="{{ $style }} {!! $className !!}" target="{!! $target !!}">
    {!! $title !!}
    @if ($style == 'btn btn--tertiary' && !$slot)
        @svg('images.svg.icons.arrow-right', 'h-3 w-3 fill-current')
    @endif
    @if ($slot)
        {!! $slot !!}
    @endif
</a>
