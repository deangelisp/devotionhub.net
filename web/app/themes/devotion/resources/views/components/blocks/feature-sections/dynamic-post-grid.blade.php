@if ($query->have_posts())
    <div id="block-pos-{!! $id !!}" class="section-page container">
        <div class="max-w-3xl mx-auto">
            <x-heading :uppertitle="$uppertitle" className="text-center">{!! $title !!}</x-heading>
            @if ($content)
                <div class="entry-content mt-8">
                    {!! $content !!}
                </div>
            @endif
        </div>


        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-12 mt-20">
            @while ($query->have_posts())
                @php($query->the_post())
                <x-card-post :title="get_the_title()" :excerpt="get_the_excerpt()" :link="get_the_permalink()" :postid="get_the_ID()"
                    :categories="get_the_category()" />
            @endwhile
            @php(wp_reset_postdata())

        </div>
        @if ($buttons)
            <x-buttons-list :buttons="$buttons" className="mt-10 justify-center" />
        @endif
    </div>

@endif
