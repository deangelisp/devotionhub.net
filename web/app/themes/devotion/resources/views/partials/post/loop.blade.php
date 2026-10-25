<div class="container section-page">
    @if ($query->have_posts())
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">
            @while ($query->have_posts())
                @php($query->the_post())
                {{-- @dd(get_the_title()) --}}
                <x-card-post :title="get_the_title()" :excerpt="get_the_excerpt()" :link="get_the_permalink()" :postid="get_the_ID()" />
            @endwhile
            @php(wp_reset_postdata())

        </div>
        <x-pagination :maxpages="$query->max_num_pages" />
    @else
        <x-alert type="warning" title="{!! $noPostsFoundTitle !!}" :buttons="[
            [
                'url' => get_home_url(),
                'label' => 'Go to home',
            ],
            [
                'label' => 'Contact us',
                'url' => get_permalink(get_page_by_path('contact-us')),
                'type' => 'secondary',
            ],
        ]">{!! $noPostsFoundMessage !!}</x-alert>
    @endif
</div>
