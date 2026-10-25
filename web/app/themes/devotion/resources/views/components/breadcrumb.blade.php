@if ($breadcrumb)

    <div class="{!! $className !!} ">
        <div class="flex items-center text-xs text-dark-tone">
            @foreach ($breadcrumb as $item)
                @if (!$loop->first)
                    <span class="mx-2">
                        @svg('images.svg.icons.arrow-right', 'h-2 w-2 fill-current')
                    </span>
                @endif

                @if ($loop->last)
                    <p class="text-dark">{!! $item['title'] !!}</p>
                @else
                    <a href="{!! $item['url'] !!}"
                        class="hover:underline hover:text-slate-900">{!! $item['title'] !!}</a>
                @endif
            @endforeach
        </div>
    </div>

@endif
