<div id="block-pos-{!! $id !!}"
    class="container section-page pt-14 sm:pt-20 md:pt-28 block-header-featured-media">
    <div class="grid lg:grid-cols-2 gap-8 lg:gap-16">
        <x-heading tag="h1" :uppertitle="$uppertitle">{!! $title !!}</x-heading>
        <div>
            <div class="entry-content">{!! $content !!}</div>
            <x-buttons-list :buttons="$buttons" className="mt-6" />
        </div>
    </div>
    @if ($image)
        <figure class="thumbnail-styled mt-12 lg:mt-20  {!! $aspect_ratio !!}">
            <x-image :id="$image" className="thumbnail" />
        </figure>
    @endif
</div>
