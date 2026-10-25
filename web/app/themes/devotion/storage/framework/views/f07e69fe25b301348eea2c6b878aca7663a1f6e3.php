<?php if($query): ?>
    <?php echo $__env->make('components.blocks.feature-sections.dynamic-post-grid', [
        'id' => 0,
        'title' => $title,
        'query' => $query,
        'block_content' => $posttype,
        'post_order' => 'manual',
        'uppertitle' => '',
        'content' => '',
        'buttons' => '',
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php /**PATH /container/application/public/web/app/themes/devotion/resources/views/components/related-posts.blade.php ENDPATH**/ ?>