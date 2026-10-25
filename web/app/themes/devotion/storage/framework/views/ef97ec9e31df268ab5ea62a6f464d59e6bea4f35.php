

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('components.blocks.header-sections.simple-header', [
        'id' => 0,
        'uppertitle' => 'Archive',
        'title' => $termTitle,
        'content' => $termContent,
        'buttons' => false,
        'textColor' => '',
        'block' => [
            'background_element' => 'none',
            'image' => '',
            'parallax' => false,
        ],
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('partials.post.loop', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if($description): ?>
        <div class="entry-content section-page container max-w-2xl">
            <?php echo $description; ?>

        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /container/application/public/web/app/themes/devotion/resources/views/category.blade.php ENDPATH**/ ?>