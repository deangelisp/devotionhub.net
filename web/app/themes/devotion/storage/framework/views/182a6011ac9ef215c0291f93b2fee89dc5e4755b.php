<div id="block-pos-<?php echo $id; ?>"
    class="mb-16  pt-20 md:pt-28 <?php if($block['background_element'] != 'none'): ?> pb-20 md:pb-28 <?php endif; ?> <?php echo $textColor; ?> block-simple-header relative">
    <?php if (isset($component)) { $__componentOriginal95d83f490c5e73ee07e97ed308e337a0a5cad09e = $component; } ?>
<?php $component = App\View\Components\BackgroundBlock::resolve(['block' => $block] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('background-block'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\BackgroundBlock::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal95d83f490c5e73ee07e97ed308e337a0a5cad09e)): ?>
<?php $component = $__componentOriginal95d83f490c5e73ee07e97ed308e337a0a5cad09e; ?>
<?php unset($__componentOriginal95d83f490c5e73ee07e97ed308e337a0a5cad09e); ?>
<?php endif; ?>
    <div class="relative container">
        <div class="lg:w-6/12">
            <?php if (isset($component)) { $__componentOriginal1308504eb5783b613a93c2370aecf0317561937f = $component; } ?>
<?php $component = App\View\Components\Heading::resolve(['uppertitle' => $uppertitle,'tag' => 'h1'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Heading::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?><?php echo $title; ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1308504eb5783b613a93c2370aecf0317561937f)): ?>
<?php $component = $__componentOriginal1308504eb5783b613a93c2370aecf0317561937f; ?>
<?php unset($__componentOriginal1308504eb5783b613a93c2370aecf0317561937f); ?>
<?php endif; ?>
            <?php if($content): ?>
                <div class="entry-content mt-4">
                    <?php echo $content; ?>

                </div>
            <?php endif; ?>
        </div>
        <?php if (isset($component)) { $__componentOriginalf85ef01bc4c2fd81fa9733f50065289af24b8fe8 = $component; } ?>
<?php $component = App\View\Components\ButtonsList::resolve(['buttons' => $buttons,'className' => 'mt-6'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('buttons-list'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\ButtonsList::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf85ef01bc4c2fd81fa9733f50065289af24b8fe8)): ?>
<?php $component = $__componentOriginalf85ef01bc4c2fd81fa9733f50065289af24b8fe8; ?>
<?php unset($__componentOriginalf85ef01bc4c2fd81fa9733f50065289af24b8fe8); ?>
<?php endif; ?>

    </div>
</div>
<?php /**PATH /container/application/public/web/app/themes/devotion/resources/views/components/blocks/header-sections/simple-header.blade.php ENDPATH**/ ?>