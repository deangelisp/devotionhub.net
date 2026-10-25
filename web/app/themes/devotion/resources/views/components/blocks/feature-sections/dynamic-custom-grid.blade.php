<div id="block-pos-{!! $id !!}" class="section-page container">
    <div class="max-w-3xl mx-auto">
        <x-heading :uppertitle="$uppertitle" className="text-center">{!! $title !!}</x-heading>
        @if ($content)
            <div class="entry-content mt-8">
                {!! $content !!}
            </div>
        @endif
    </div>
    @if ($gridContent)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-12 mt-20">
            @foreach ($gridContent as $item)
                <div class="text-center flex items-center flex-col ">
                    @if ($item['image'])
                        @if ($mediaType == 'image')
                            <figure
                                class="radius overflow-hidden relative  mb-2 lg:mb-4 {!! $aspectRatio !!} @if ($aspectRatio != 'auto') thumbnail-styled w-full @endif">
                                <x-image :id="$item['image']" className="thumbnail" aspect="auto" />
                            </figure>
                        @else
                            <figure class="relative  mb-2 lg:mb-4 aspect-square w-20 thumbnail-frame radius">
                                <x-image :id="$item['image']" className="thumbnail object-center object-contain"
                                    aspect="auto" />
                            </figure>
                        @endif
                    @endif
                    <h3 class="text-2xl mb-6">{!! $item['title'] !!}</h3>

                    @if ($item['content'])
                        <p>
                            {!! $item['content'] !!}
                        </p>
                    @endif

                    @if ($item['link'])
                        <x-button :link="$item['link']" :style="$item['link_style']" className="mt-6" />
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    @if ($buttons)
        <div class="flex justify-center mt-10">
            <x-buttons-list :buttons="$buttons" />
        </div>
    @endif
</div>
