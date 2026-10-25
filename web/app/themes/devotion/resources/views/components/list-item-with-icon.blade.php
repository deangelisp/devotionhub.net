<span class="flex items-start">
    @svg('images.svg.icons.' . $icon, 'h-6 w-6 mt-2 mr-5 fill-current text-dark-tone flex-shrink-0')
    <span>
        <h3 class="text-sm text-dark-tone font-normal">{!! $title !!}</h3>
        @if (containsHTML($slot))
            {!! $slot !!}
        @else
            <p>{!! $slot !!}</p>
        @endif
    </span>
</span>
