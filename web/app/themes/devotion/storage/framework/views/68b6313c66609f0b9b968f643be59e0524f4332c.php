<?php if($navbar): ?>
    <header id="main-header"
        class="main-header-navbar flex justify-center flex-col sticky top-0  navbar-<?php echo $navbar; ?>">
        <?php echo $__env->make('sections.header.blocks.' . $navbar, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('sections.header.progress-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </header>
    <?php echo $__env->make('sections.header.mobile-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php /**PATH /app/web/app/themes/devotion/resources/views/sections/header.blade.php ENDPATH**/ ?>