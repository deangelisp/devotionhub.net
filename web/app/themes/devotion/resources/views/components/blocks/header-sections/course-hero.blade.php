<div id="block-pos-{!! $id !!}" class="section-page block-course-hero relative overflow-hidden text-white">
    <div class="block-course-hero__glow" aria-hidden="true"></div>

    <div class="container relative grid lg:grid-cols-12 gap-14 lg:gap-16 items-center py-16 md:py-24">
        <div class="lg:col-span-5">
            @if ($uppertitle)
                <p class="block-course-hero__eyebrow mb-5">{!! $uppertitle !!}</p>
            @endif

            <h1 class="text-4xl md:text-5xl xl:text-6xl font-bold leading-tight">{!! $title !!}</h1>

            @if ($subtitle)
                <p class="mt-4 text-xl md:text-2xl font-medium text-white/80">{!! $subtitle !!}</p>
            @endif

            @if ($content)
                <div class="entry-content mt-6 text-white/80">
                    {!! $content !!}
                </div>
            @endif

            @if ($primaryButton || $secondaryButton)
                <div class="flex flex-col sm:flex-row gap-3 mt-10">
                    @if ($primaryButton)
                        <a href="{!! $primaryButton['url'] !!}" target="{!! $primaryButton['target'] ?: '_self' !!}"
                            class="btn--highlight block-course-hero__join">
                            {!! $primaryButton['title'] !!}
                            @svg('images.svg.icons.arrow-right', 'h-3 w-3 fill-current')
                        </a>
                    @endif
                    @if ($secondaryButton)
                        <a href="{!! $secondaryButton['url'] !!}" target="{!! $secondaryButton['target'] ?: '_self' !!}"
                            class="btn block-course-hero__login">
                            {!! $secondaryButton['title'] !!}
                        </a>
                    @endif
                </div>
            @endif

            @if ($note)
                <p class="mt-4 text-sm text-white/60">{!! $note !!}</p>
            @endif
        </div>

        @if ($image)
            <div class="lg:col-span-7 relative pb-8 lg:pb-0">
                <div class="block-course-hero__browser">
                    <div class="block-course-hero__browser-bar" aria-hidden="true">
                        <span></span><span></span><span></span>
                        <p>app.devotionhub.net</p>
                    </div>
                    <x-image :id="$image" className="block w-full h-auto" aspect="auto" size="massive" />
                </div>

                @if ($imagePhone)
                    <div class="block-course-hero__phone">
                        <x-image :id="$imagePhone" className="block w-full h-auto" aspect="auto" size="medium_large" />
                    </div>
                @endif
            </div>
        @endif
    </div>
</div>
