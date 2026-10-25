<a class="sr-only focus:not-sr-only" href="#main">
    <?php echo e(__('Skip to content')); ?>

</a>

<?php if (isset($component)) { $__componentOriginal90268ef6718a3aeafa6490cf47f50286b37e80fd = $component; } ?>
<?php $component = App\View\Components\HeaderSpotlightBar::resolve(['message' => $headerSpotilight] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('header-spotlight-bar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\HeaderSpotlightBar::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal90268ef6718a3aeafa6490cf47f50286b37e80fd)): ?>
<?php $component = $__componentOriginal90268ef6718a3aeafa6490cf47f50286b37e80fd; ?>
<?php unset($__componentOriginal90268ef6718a3aeafa6490cf47f50286b37e80fd); ?>
<?php endif; ?>
<?php echo $__env->make('sections.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<main id="main" class="main flex-grow">
    <?php echo $__env->yieldContent('content'); ?>
</main>


<?php echo $__env->make('sections.global', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('sections.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /container/application/public/web/app/themes/devotion/resources/views/layouts/app.blade.php ENDPATH**/ ?>