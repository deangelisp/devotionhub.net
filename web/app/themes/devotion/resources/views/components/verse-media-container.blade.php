@if ($media)
    <script src="https://www.youtube.com/iframe_api"></script>
    <div class="mt-8 grid grid-cols-2 gap-3 verse-media-container">
        @foreach ($media as $key => $item)
            <div>
                <div class="verse-media-container-item aspect-reel overflow-hidden rounded-md thumbnail-frame">
                    <img src="{!! $item['thumbnail'] !!}" alt="{!! $item['title'] !!}" class="thumbnail" width="194"
                        height="335">

                    <div class="vignette">
                    </div>

                    @svg('images.svg.icons.youtube-short-logo', 'absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-16 h-16 youtube-logo')
                    @svg('images.svg.icons.youtube-short-play', 'absolute bottom-0 left-0 w-11 h-auto fill-white opacity-90')
                    @svg('images.svg.icons.youtube-short-name', 'absolute bottom-0.5 right-0.5 w-24 h-auto fill-white opacity-90')
                    <div id="youtube-player-{{ $key }}" data-video-id="{!! $item['id'] !!}"
                        class="w-full h-full  youtube-player-item absolute left-0 top-0 cursor-pointer z-10"></div>
                </div>
                @if ($displaytitle)
                    <p class="text-sm font-semibold text-center mt-2">
                        <a href="{!! $item['url'] !!}"
                            class=" hover:text-blue-700 hover:underline">{!! $item['title'] !!}</a>
                    </p>
                @endif
            </div>
        @endforeach
    </div>
@endif
