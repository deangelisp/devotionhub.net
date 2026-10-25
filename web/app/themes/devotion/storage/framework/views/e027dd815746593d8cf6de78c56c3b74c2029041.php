<?php if($crossReferences): ?>
    <div class="container section-page">
        <h2 class="mb-8">Cross References for <?php echo $title; ?></h2>
        <div class="">
            <?php $__currentLoopData = $crossReferences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $crossReference): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div>
                    <?php if(isset($crossReference['verse'])): ?>
                        <h3 class="mb-4"><?php echo $title; ?>:<?php echo $crossReference['verse']; ?></h3>
                    <?php endif; ?>
                    <div class="grid grid-cols-4 gap-x-6 gap-y-5 mb-12">
                        <?php $__currentLoopData = $crossReference['references']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ref): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <p class="cross-reference-loop-item text-sm  pb-5 relative">
                                <span class="relative block">
                                    <span class="font-semibold"><?php echo $ref['verse']; ?></span> -
                                    <span><?php echo $ref['text']; ?></span>
                                </span>
                                <span
                                    class="block text-xs absolute bottom-0 left-0 w-full text-center text-dark-tone opacity-0 transition-all duration-300">Click
                                    to read the verse <?php echo $ref['verse']; ?></span>
                                <a href="<?php echo $ref['url']; ?>" class="cross-reference-loop-item-link"><span
                                        class="sr-only">Click
                                        to read the verse <?php echo $ref['verse']; ?></span></a>
                            </p>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH /container/application/public/web/app/themes/devotion/resources/views/components/cross-references.blade.php ENDPATH**/ ?>