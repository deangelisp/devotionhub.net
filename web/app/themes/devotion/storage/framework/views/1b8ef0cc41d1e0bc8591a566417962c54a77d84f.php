<div id="block-pos-<?php echo $id; ?>" class=" section-page block-content">
    <div class="<?php echo $className; ?> container ">
        <?php if($title): ?>
            <?php if (isset($component)) { $__componentOriginal1308504eb5783b613a93c2370aecf0317561937f = $component; } ?>
<?php $component = App\View\Components\Heading::resolve(['uppertitle' => $uppertitle] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
        <?php endif; ?>
        <div class="entry-content mt-8"><?php echo $content; ?></div>
    </div>
</div>
<?php /**PATH /container/application/public/web/app/themes/devotion/resources/views/components/blocks/long-form-content-sections/content.blade.php ENDPATH**/ ?>