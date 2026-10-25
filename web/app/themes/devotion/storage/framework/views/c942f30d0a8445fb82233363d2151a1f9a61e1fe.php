<div id="block-pos-<?php echo $id; ?>" class="section-page container block-faq-accordion-list">
    <div class="max-w-4xl mx-auto">
        <?php if (isset($component)) { $__componentOriginal1308504eb5783b613a93c2370aecf0317561937f = $component; } ?>
<?php $component = App\View\Components\Heading::resolve(['uppertitle' => $uppertitle,'className' => 'text-center'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
            <div class="entry-content mt-6">
                <?php echo $content; ?>

            </div>
        <?php endif; ?>
        <?php if($faqList): ?>
            <div class="mt-12">
                <?php if (isset($component)) { $__componentOriginal07bd075ba71540b0aa19264bc0b60dc746e5b280 = $component; } ?>
<?php $component = App\View\Components\AccordionList::resolve(['items' => $faqList] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('accordion-list'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AccordionList::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal07bd075ba71540b0aa19264bc0b60dc746e5b280)): ?>
<?php $component = $__componentOriginal07bd075ba71540b0aa19264bc0b60dc746e5b280; ?>
<?php unset($__componentOriginal07bd075ba71540b0aa19264bc0b60dc746e5b280); ?>
<?php endif; ?>
            </div>
        <?php endif; ?>
        <?php if($footer): ?>
            <div class="mt-12 lg:mt-20 entry-content ">
                <?php echo $footer; ?>

            </div>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH /container/application/public/web/app/themes/devotion/resources/views/components/blocks/faq-sections/faq-accordion-list.blade.php ENDPATH**/ ?>