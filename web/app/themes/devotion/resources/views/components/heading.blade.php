<{!! $tag !!} class="{!! $className !!}">
    @if ($uppertitle)
        <span class="block mb-3 text-base font-normal">{!! $uppertitle !!}</span>
    @endif
    {{ $slot }}
    </{!! $tag !!}>
