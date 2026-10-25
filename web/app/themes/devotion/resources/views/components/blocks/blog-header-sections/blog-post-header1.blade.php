<div class="container grid grid-cols-1 lg:grid-cols-3 gap-12 md:gap-20 section-page
    pt-20 md:pt-28">
    <div>
        <span class="block">
            <a href="{!! $postsLink !!}" class="inline-flex items-center gap-2 mb-6 md:mb-8">
                @svg('images.svg.icons.arrow-left', 'w-3 h-3')
                All Posts
            </a>
            <div class="flex items-start gap-4 mb-6 md:mb-8 justify-between">
                <div class="flex items-center flex-wrap gap-2">
                    @foreach ($categories as $category)
                        <x-chip :link="get_category_link($category->term_id)" size="md">
                            {!! $category->name !!}
                        </x-chip>
                    @endforeach
                </div>

                @if ($reading)
                    <span class="text-sm font-semibold flex-shrink-0 py-1">{!! $reading !!} min read</span>
                @endif
            </div>
            <h1 class="text-4xl md:text-5xl leading-tight mb-6 md:mb-8">{!! $title !!}</h1>
            <p class="text-sm">Published on {!! $publishedon !!}</p>
        </span>
    </div>
    <figure class="lg:col-span-2 aspect-video thumbnail-frame">
        <x-image :id="$image" className="thumbnail" />
    </figure>
</div>
