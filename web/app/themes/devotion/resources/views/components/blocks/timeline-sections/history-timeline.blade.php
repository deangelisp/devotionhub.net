@if ($history)
    <div class="container block-history-timeline ">
        <div class=" max-w-4xl mx-auto flex items-stretch">
            <div id="block-history-timeline-bar"
                class="block-history-timeline-bar mr-5 md:mr-10 relative flex-shrink-0  md:-z-10 overflow-hidden">
                <div class="block-history-timeline-bar-line h-full absolute top-0 left-0"></div>
                <div id="block-history-timeline-bar-progress" class="block-history-timeline-bar-progress"></div>
            </div>
            <div class="pt-20">
                @foreach ($history as $item)
                    <div class="section-page relative">
                        <span
                            class="block rounded-full w-4 h-4 bg-medium-light-tone absolute block-history-timeline-bullet"></span>
                        <span class="text-3xl mb-1 block">{!! $item['date'] !!}</span>
                        <h3 class="text-xl font-bold">{!! $item['title'] !!}</h3>
                        @if ($item['content'])
                            <div class="entry-content mt-4">
                                {!! $item['content'] !!}
                            </div>
                        @endif

                        @if ($item['buttons'])
                            <x-buttons-list :buttons="$item['buttons']" className="mt-12" />
                        @endif

                        @if ($item['image'])
                            <figure class="mt-12 thumbnail-frame aspect-video">
                                <x-image :id="$item['image']" className="thumbnail" />
                            </figure>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
