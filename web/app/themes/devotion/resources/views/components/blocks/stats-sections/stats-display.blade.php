@if ($stats)
    <div id="block-pos-{!! $id !!}"
        class="section-page block-stats-display relative @if ($hasBackground) py-20 text-white @endif">
        <x-background-block :block="$block" />
        <div class="container relative z-10">
            <div class="grid md:grid-cols-2 gap-5 md:gap-20 ">
                <div>
                    <x-heading :uppertitle="$uppertitle">{{ $title }}</x-heading>
                </div>
                <div>
                    @if ($content)
                        <div class="entry-content ">
                            {!! $content !!}
                        </div>
                    @endif
                    @if ($buttons)
                        <x-buttons-list :buttons="$buttons" className="mt-10" />
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-2 {!! $gridClassName !!} gap-10 mt-12 md:mt-20">
                @foreach ($stats as $stat)
                    <div>
                        <p class="font-bold">
                            <span class="text-6xl lg:text-8xl mb-1">{!! $stat['value'] !!}</span>
                            @if ($stat['title'])
                                <span class="md:text-lg block">{!! $stat['title'] !!}</span>
                            @endif
                        </p>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endif
