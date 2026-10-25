


<div class="p-4 mb-4  border radius <?php echo $className; ?>" role="alert">
    <?php if($title): ?>
        <div class="flex items-center">
            <?php echo e(get_svg('images.svg.icons.info', 'h-4 w-4 fill-current mr-2')); ?>
            <span class="text-lg font-medium"><?php echo $title; ?></span>
        </div>
    <?php endif; ?>
    <?php if($slot): ?>
        <div class="<?php if($title): ?> mt-2 <?php endif; ?> text-sm entry-content">
            <p><?php echo $slot; ?></p>
        </div>
    <?php endif; ?>
    <div class="flex gap-2">
        <?php if($buttons): ?>
            <?php $__currentLoopData = $buttons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $button): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e($button['url']); ?>"
                    class="btn-alert btn-alert--<?php echo $button['type'] ?? ''; ?> <?php echo $type; ?> small">
                    <?php echo $button['label']; ?>

                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        
    </div>
</div>
<?php /**PATH /container/application/public/web/app/themes/devotion/resources/views/components/alert.blade.php ENDPATH**/ ?>