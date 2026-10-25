@if ($meta)
    <div class="flex items-center gap-7 text-sm">
        @foreach ($meta as $item)
            @if (is_array($item))
                <a class="hover:underline" href="{!! $item['link'] !!}">{!! $item['name'] !!}</a>
            @else
                <span>{!! $item !!}</span>
            @endif
        @endforeach
    </div>
@endif
