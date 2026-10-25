@if ($maxNumPages > 1)
    <div class="pagination mt-20 flex items-center justify-center gap-2">
        {!! paginate_links([
            'total' => $maxNumPages,
            'current' => max(1, get_query_var('paged')),
            'format' => 'page/%#%/',
            'show_all' => false,
            'prev_next' => true,
            'prev_text' => $prev,
            'next_text' => $next,
        ]) !!}
    </div>
@endif
