<?php if($items): ?>
    <div class="accordion-container <?php echo $className; ?>">
        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="accordion-item">
                <div class="accordion-heading cursor-pointer select-none py-5 flex items-center">
                    <h3 class="text-xl w-full ">
                        <?php echo $item['heading']; ?>

                    </h3>
                    <span class="block  flex-shrink-0 p-2">
                        <?php echo e(get_svg('images.svg.icons.arrow-down', 'w-4 h-4 fill-current accordion-icon -rotate-90 transition-all')); ?>
                    </span>
                </div>
                <div class="accordion-content ">
                    <div class="entry-content pb-5">
                        <?php echo $item['body']; ?>

                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <?php echo getFaqStructuredData($items); ?>

<?php endif; ?>
<?php /**PATH /container/application/public/web/app/themes/devotion/resources/views/components/accordion-list.blade.php ENDPATH**/ ?>