<?php if($footer == 'Footer7'): ?>
    <?php if (isset($component)) { $__componentOriginald54e83069392260488dbfc00990739fc30a0e540 = $component; } ?>
<?php $component = App\View\Components\Blocks\Footer\Footer7::resolve(['logo' => $footerLogo,'copyright' => $copyright] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('blocks.footer.footer7'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Blocks\Footer\Footer7::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald54e83069392260488dbfc00990739fc30a0e540)): ?>
<?php $component = $__componentOriginald54e83069392260488dbfc00990739fc30a0e540; ?>
<?php unset($__componentOriginald54e83069392260488dbfc00990739fc30a0e540); ?>
<?php endif; ?>
<?php else: ?>
    <?php if (isset($component)) { $__componentOriginal8a6e65c62ce35067bbf22b7b1ceb8f4c0da382ce = $component; } ?>
<?php $component = App\View\Components\Blocks\Footer\Footer3::resolve(['logo' => $footerLogo,'socials' => $siteSocialMedias,'copyright' => $copyright,'address' => $address,'phone' => $phone,'email' => $email] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('blocks.footer.footer3'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Blocks\Footer\Footer3::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8a6e65c62ce35067bbf22b7b1ceb8f4c0da382ce)): ?>
<?php $component = $__componentOriginal8a6e65c62ce35067bbf22b7b1ceb8f4c0da382ce; ?>
<?php unset($__componentOriginal8a6e65c62ce35067bbf22b7b1ceb8f4c0da382ce); ?>
<?php endif; ?>
<?php endif; ?>
<?php /**PATH /container/application/public/web/app/themes/devotion/resources/views/sections/footer.blade.php ENDPATH**/ ?>