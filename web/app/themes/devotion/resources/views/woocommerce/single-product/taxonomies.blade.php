@if ($taxonomies)
    <div class="pt-3 mt-5 border-t border-light-tone mb-10 text-xs">
        @foreach ($taxonomies as $taxonomy)
            <p class="@if (!$loop->first) mt-2 @endif">
                <span class="text-dark-tone">{!! $taxonomy['label'] !!}: </span>
                @foreach ($taxonomy['items'] as $item)
                    @if (!$loop->first)
                        ,
                    @endif
                    <a class=" hover:underline" href="{!! $item['url'] !!}">{!! $item['title'] !!}</a>
                @endforeach
            </p>
        @endforeach
    </div>
@endif
