@if ($iconBoxes)
    <div class="product-iconboxes grid grid-cols-2 gap-6">
        @foreach ($iconBoxes as $item)
            <div class="flex items-center">
                <figure class="flex-shrink-0 mr-3 w-10 h-10 border border-light-tone p-2 rounded-full">
                    {!! $item['icon'] !!}
                </figure>
                <div class="text-xs ">
                    <p class="font-bold">{!! $item['title'] !!}</p>
                    <p class="text-dark-tone">{!! $item['description'] !!}</p>
                </div>
            </div>
        @endforeach
    </div>
@endif
