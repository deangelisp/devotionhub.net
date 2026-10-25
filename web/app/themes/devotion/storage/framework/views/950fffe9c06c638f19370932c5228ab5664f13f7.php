

<?php $__env->startSection('content'); ?>
    <div class="lg:flex gap-20 container section-page pt-10 sm:pt-20">
        <div class="w-full">
            <div class="mb-10 md:mb-20 flex items-center justify-between gap-10">
                <div>
                    <h1 class="text-4xl ">
                        <?php echo $title; ?>

                    </h1>
                    <p class="block text-base font-normal text-gray-400 mt-4 max-w-xl"><?php echo $excerpt; ?></p>
                </div>
                <figure class="hidden md:block">
                    <?php echo $thumbnail; ?>

                </figure>
            </div>

            <?php if($chapters): ?>
                <h2 class="text-2xl font-bold mb-4">Chapters in <?php echo $title; ?></h2>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3 sm:gap-4 lg:gap-5 section-page">
                    <?php $__currentLoopData = $chapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if (isset($component)) { $__componentOriginal4c1f11b0c1030e5ad736092f00d759d541b643ac = $component; } ?>
<?php $component = App\View\Components\CardChapter::resolve(['chapter' => $chapter,'url' => $url] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('card-chapter'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\CardChapter::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4c1f11b0c1030e5ad736092f00d759d541b643ac)): ?>
<?php $component = $__componentOriginal4c1f11b0c1030e5ad736092f00d759d541b643ac; ?>
<?php unset($__componentOriginal4c1f11b0c1030e5ad736092f00d759d541b643ac); ?>
<?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

            <?php if($description): ?>
                <h2 class="text-2xl font-bold mb-4">Summary of the <?php echo $title; ?></h2>
                <div class="entry-content">
                    <?php echo $description; ?>

                </div>
            <?php endif; ?>

            
            <?php if($faq): ?>
                <div class="mt-16">
                    <?php echo $__env->make('components.blocks.faq-sections.faq-accordion-list', $faq, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            <?php endif; ?>


        </div>

        <aside class="relative chapter-sidebar flex-shrink-0 pt-20 lg:pt-40">
            <div class="sticky top-28">
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.search-bar','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('search-bar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginalce50a94ff087985e364bd12ef648ff49681f48c5 = $component; } ?>
<?php $component = App\View\Components\BibleBooksCloud::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('bible-books-cloud'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\BibleBooksCloud::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce50a94ff087985e364bd12ef648ff49681f48c5)): ?>
<?php $component = $__componentOriginalce50a94ff087985e364bd12ef648ff49681f48c5; ?>
<?php unset($__componentOriginalce50a94ff087985e364bd12ef648ff49681f48c5); ?>
<?php endif; ?>
            </div>
        </aside>
    </div>
    <?php if(isset($extraData) && $extraData): ?>
        <?php echo $__env->make('partials.blocks.init', ['blocks' => $extraData], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /container/application/public/web/app/themes/devotion/resources/views/archive-bible_chapter.blade.php ENDPATH**/ ?>