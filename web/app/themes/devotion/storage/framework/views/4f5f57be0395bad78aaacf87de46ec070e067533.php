<div class="container grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-20 block-contact-info-and-form section-page">
    <div>
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
        <?php if($content): ?>
            <div class="entry-content mt-4 ">
                <?php echo $content; ?>

            </div>
        <?php endif; ?>
        <div class="mt-8 md:mt-12">
            <?php if($email): ?>
                <p>
                    <a class="inline-flex items-center link-on-hover" href="mailto:<?php echo $email; ?>">
                        <?php echo e(get_svg('images.svg.icons.email', 'h-5 w-5 inline-block mr-4 flex-shrink-0')); ?>
                        <span><?php echo $email; ?></span>
                    </a>
                </p>
            <?php endif; ?>
            <?php if($phone): ?>
                <p class="mt-6">
                    <a class="inline-flex items-center link-on-hover" href="tel:<?php echo generate_tel_url($phone); ?>">
                        <?php echo e(get_svg('images.svg.icons.phone', 'h-5 w-5 inline-block mr-4 flex-shrink-0')); ?>
                        <span><?php echo $phone; ?></span>
                    </a>
                </p>
            <?php endif; ?>
            <?php if($address): ?>
                <p class="mt-6">
                    <?php echo e(get_svg('images.svg.icons.location', 'h-5 w-5 inline-block mr-4 flex-shrink-0')); ?>
                    <span><?php echo $address; ?></span>
                </p>
            <?php endif; ?>
        </div>
    </div>
    <div>
        <?php if($forminatorFormId): ?>
            <?php echo do_shortcode('[forminator_form id="' . $forminatorFormId . '"]'); ?>

        <?php endif; ?>
    </div>
</div>
<?php /**PATH /container/application/public/web/app/themes/devotion/resources/views/components/blocks/contact-sections/contact-info-and-form.blade.php ENDPATH**/ ?>