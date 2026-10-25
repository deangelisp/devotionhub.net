<div id="block-pos-{!! $id !!}"
    class="container section-page grid lg:grid-cols-2 gap-12 md:gap-20 items-center  block-media-and-content">
    <div class="@if ($imagePositioning == 'image-left') lg:order-2 @endif">
        <x-heading :uppertitle="$uppertitle">{{ $title }}</x-heading>
        @if ($content)
            <div class="entry-content mt-6 ">
                {!! $content !!}
            </div>
        @endif

        @if ($listItems)
            <div class="grid @if ($listItemType == 'grid') sm:grid-cols-2 @endif mt-8 gap-8">
                @foreach ($listItems as $item)
                    <div class="flex items-start gap-4">
                        @if ($item['image'])
                            <x-image :id="$item['image']" className="mt-1 w-7 h-7 flex-shrink-0" />
                        @endif
                        <div>
                            <h3 class="@if ($titleSize == 'large') text-5xl @else text-xl @endif mb-4">
                                {{ $item['title'] }}</h3>
                            <p>{{ $item['content'] }}</p>
                            @if ($item['link'])
                                <a href="{!! $item['link']['url'] !!}"
                                    class="text-sm underline text-medium-dark-tone inline-block mt-2">
                                    {!! $item['link']['title'] !!}
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        @if ($buttons)
            <x-buttons-list :buttons="$buttons" className="mt-10" />
        @endif
    </div>
    <div class="relative">
        @if ($imagePositioning == 'image-left')
            <div class="thumbnail-styled bg-primary"></div>
        @else
            <div class="thumbnail-styled bg-accent"></div>
        @endif
        <figure
            class="@if ($imagePositioning == 'image-left') lg:order-1 @endif {!! $aspect_ratio !!} @if ($aspect_ratio != 'auto') thumbnail-styled @endif rounded-lg">
            <x-image :id="$image" className="thumbnail" />
        </figure>

    </div>
</div>
