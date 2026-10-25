<div>
    @if ($rating)
        <div class="flex items-center mb-8 gap-1">
            @for ($i = 0; $i < $rating; $i++)
                @svg('images.svg.icons.star', 'h-6 w-6 text-primary')
            @endfor
        </div>
    @endif
    <p class="font-normal md:font-bold text-xl md:text-2xl mb-8">"{!! $testimonial !!}"</p>

    <div class="flex gap-3 sm:gap-6 flex-col sm:flex-row">
        <div class="flex items-center gap-5">
            @if ($thumbnail)
                <figure class="thumbnail-frame rounded-full flex-shrink-0 w-14 h-14">
                    <x-image :id="$thumbnail" className="thumbnail" size="thumbnail" />
                </figure>
            @endif
            <div>
                <p class="font-semibold">{!! $author !!}</p>
                <p>{!! $authorDescription !!}</p>
            </div>
        </div>
        @if ($logo)
            <div class="pl-20 sm:pl-6 sm:border-l border-medium-tone flex items-center">
                <x-image :id="$logo" className="w-24" />
            </div>
        @endif
    </div>
</div>
