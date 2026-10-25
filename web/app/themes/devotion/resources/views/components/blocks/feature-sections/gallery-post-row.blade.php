@if ($gallery)
    <div id="block-pos-{!! $id !!}" class="section-page block-gallery-post-row">

        @if ($title || $content)
            <div class="container grid md:grid-cols-2 gap-10 md:gap-20 mb-10 md:mb-20">
                <div>
                    <x-heading :uppertitle="$uppertitle">{!! $title !!}</x-heading>
                </div>
                <div>
                    <div class="entry-content">
                        {!! $content !!}
                    </div>

                    @if ($buttons)
                        <div class="mt-6 md:mt-10">
                            <x-buttons-list :buttons="$buttons" />
                        </div>
                    @endif
                </div>
            </div>
        @endif

        @foreach ($gallery as $key => $row)
            <div class="gallery-horizontal-scroll" @if ($key % 2 != 0) data-scroll-origin="right" @endif>
                @foreach ($row as $item)
                    @if ($item['link'])
                        <a href="{!! $item['link'] !!}"
                            class="aspect-square flex-none thumbnail-frame gallery-horizontal-scroll-item"
                            aria-label="{!! $item['title'] !!}">
                            <span class="sr-only">{!! $item['title'] !!}</span>
                            <x-image :id="$item['image']" className="thumbnail" aspect="auto" />
                        </a>
                    @else
                        <figure class="aspect-square flex-none thumbnail-frame gallery-horizontal-scroll-item ">
                            <x-image :id="$item['image']" className="thumbnail" aspect="auto" />
                        </figure>
                    @endif
                @endforeach
            </div>
        @endforeach
    </div>
@endif
