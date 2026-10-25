<{!! $tag !!} @if ($link) href="{{ $link }}" @endif
    class="{!! $className !!} inline-flex items-center gap-2 radius font-semibold">
    {!! $slot !!}
    </{!! $tag !!}>
