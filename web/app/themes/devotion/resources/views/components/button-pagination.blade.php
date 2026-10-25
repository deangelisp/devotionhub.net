<a href="{!! $url !!}" class="inline-flex items-center gap-3">
    @if ($side == 'left')
        @svg('images.svg.icons.arrow-left', ['class' => 'w-6 h-6 text-slate-500 flex-shrink-0'])
    @endif
    <span class="block">
        <span class="block font-semibold">{!! $title !!}</span>
        <span class="block">{!! $subtitle !!}</span>
    </span>
    @if ($side == 'right')
        @svg('images.svg.icons.arrow-right', ['class' => 'w-6 h-6 text-slate-500 flex-shrink-0'])
    @endif
</a>
