<div class="section-page">

    <?php if($content): ?>
        <div class="entry-content container mb-10"><?php echo $content; ?></div>
    <?php endif; ?>

    <?php echo $__env->make('partials.post.loop', [
        'type' => 'case_study',
        'query' => $query,
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php /**PATH /container/application/public/web/app/themes/devotion/resources/views/components/blocks/archive-posts/posts.blade.php ENDPATH**/ ?>