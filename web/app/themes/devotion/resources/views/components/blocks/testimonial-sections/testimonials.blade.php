@if ($query->have_posts())
    <div id="block-pos-{!! $id !!}" class="container section-page block-testimonials">
        <x-heading :uppertitle="$uppertitle">{!! $title !!}</x-heading>
        @if ($content)
            <div class="entry-content mt-6">
                {!! $content !!}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 mt-20">
            @while ($query->have_posts())
                @php($query->the_post())
                <x-card-testimonial :id="get_the_ID()" />
            @endwhile
            @php(wp_reset_postdata())

        </div>
        @if ($buttons)
            <x-buttons-list :buttons="$buttons" className="mt-10 justify-center" />
        @endif
    </div>
@endif
