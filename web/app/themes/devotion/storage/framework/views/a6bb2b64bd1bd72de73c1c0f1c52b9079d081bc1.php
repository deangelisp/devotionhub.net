<div class="card card--post">
    <figure class="radius overflow-hidden relative  mb-2 lg:mb-4 aspect-video thumbnail-styled">
        <?php echo $thumbnail; ?>

        <a href="<?php echo $link; ?>" class="absolute inset-0 z-10" aria-label="<?php echo $title; ?>">
            <span class="sr-only"><?php echo $title; ?></span>
        </a>
    </figure>

    <?php if (isset($component)) { $__componentOriginale38aa8c4622482e410f91da9093b2ae0c3697c82 = $component; } ?>
<?php $component = App\View\Components\TermsList::resolve(['terms' => $categories] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('terms-list'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\TermsList::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale38aa8c4622482e410f91da9093b2ae0c3697c82)): ?>
<?php $component = $__componentOriginale38aa8c4622482e410f91da9093b2ae0c3697c82; ?>
<?php unset($__componentOriginale38aa8c4622482e410f91da9093b2ae0c3697c82); ?>
<?php endif; ?>

    <h3 class="text-xl lg:text-2xl">
        <a href="<?php echo $link; ?>" class="hover:underline"><?php echo $title; ?></a>
    </h3>
    <?php if($excerpt): ?>
        <p class="text-dark-tone"><?php echo $excerpt; ?></p>
    <?php endif; ?>
</div>
<?php /**PATH /container/application/public/web/app/themes/devotion/resources/views/components/card-post.blade.php ENDPATH**/ ?>