<div class="flex  justify-between items-center container">
    <?php echo $__env->make('sections.header.logo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="flex items-center gap-10">
        <div class=" hidden  lg:flex justify-center">
            <?php echo $__env->make('sections.header.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="flex justify-end items-center">
            <?php echo $__env->make('sections.header.actions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</div>
<?php /**PATH /container/application/public/web/app/themes/devotion/resources/views/sections/header/blocks/navbar2.blade.php ENDPATH**/ ?>