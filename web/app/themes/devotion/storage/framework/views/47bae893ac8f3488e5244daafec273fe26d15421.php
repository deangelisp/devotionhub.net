

<?php $__env->startSection('content'); ?>
    <?php if(!have_posts()): ?>
        <?php echo $__env->make('partials.blocks.init', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /container/application/public/web/app/themes/devotion/resources/views/404.blade.php ENDPATH**/ ?>