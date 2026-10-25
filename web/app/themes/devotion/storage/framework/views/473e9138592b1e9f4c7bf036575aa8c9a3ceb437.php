<?php if($maxNumPages > 1): ?>
    <div class="pagination mt-20 flex items-center justify-center gap-2">
        <?php echo paginate_links([
            'total' => $maxNumPages,
            'current' => max(1, get_query_var('paged')),
            'format' => 'page/%#%/',
            'show_all' => false,
            'prev_next' => true,
            'prev_text' => $prev,
            'next_text' => $next,
        ]); ?>

    </div>
<?php endif; ?>
<?php /**PATH /container/application/public/web/app/themes/devotion/resources/views/components/pagination.blade.php ENDPATH**/ ?>