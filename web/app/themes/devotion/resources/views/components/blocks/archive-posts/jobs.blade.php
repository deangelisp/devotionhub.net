<div class="section-page container max-w-4xl">
    @if ($query->have_posts())

        @while ($query->have_posts())
            @php($query->the_post())
            <x-card-job :id="get_the_ID()" />
        @endwhile
        @php(wp_reset_postdata())
        <x-pagination :maxpages="$query->max_num_pages" />
    @else
        <div class="entry-content">
            {!! $noPostsFoundMessage !!}
        </div>
    @endif


</div>
