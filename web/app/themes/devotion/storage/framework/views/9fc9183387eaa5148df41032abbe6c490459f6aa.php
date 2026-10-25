<div id="block-pos-<?php echo $id; ?>"
    class="container section-page grid lg:grid-cols-2 gap-12 md:gap-20 items-center  block-media-and-content">
    <div class="<?php if($imagePositioning == 'image-left'): ?> lg:order-2 <?php endif; ?>">
        <?php if (isset($component)) { $__componentOriginal1308504eb5783b613a93c2370aecf0317561937f = $component; } ?>
<?php $component = App\View\Components\Heading::resolve(['uppertitle' => $uppertitle] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Heading::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?><?php echo e($title); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1308504eb5783b613a93c2370aecf0317561937f)): ?>
<?php $component = $__componentOriginal1308504eb5783b613a93c2370aecf0317561937f; ?>
<?php unset($__componentOriginal1308504eb5783b613a93c2370aecf0317561937f); ?>
<?php endif; ?>
        <?php if($content): ?>
            <div class="entry-content mt-6 ">
                <?php echo $content; ?>

            </div>
        <?php endif; ?>

        <?php if($listItems): ?>
            <div class="grid <?php if($listItemType == 'grid'): ?> sm:grid-cols-2 <?php endif; ?> mt-8 gap-8">
                <?php $__currentLoopData = $listItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex items-start gap-4">
                        <?php if($item['image']): ?>
                            <?php if (isset($component)) { $__componentOriginalcf1fde6bef2907c23498101ce01c0f3f2594e0bd = $component; } ?>
<?php $component = App\View\Components\Image::resolve(['id' => $item['image'],'className' => 'mt-1 w-7 h-7 flex-shrink-0'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Image::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcf1fde6bef2907c23498101ce01c0f3f2594e0bd)): ?>
<?php $component = $__componentOriginalcf1fde6bef2907c23498101ce01c0f3f2594e0bd; ?>
<?php unset($__componentOriginalcf1fde6bef2907c23498101ce01c0f3f2594e0bd); ?>
<?php endif; ?>
                        <?php endif; ?>
                        <div>
                            <h3 class="<?php if($titleSize == 'large'): ?> text-5xl <?php else: ?> text-xl <?php endif; ?> mb-4">
                                <?php echo e($item['title']); ?></h3>
                            <p><?php echo e($item['content']); ?></p>
                            <?php if($item['link']): ?>
                                <a href="<?php echo $item['link']['url']; ?>"
                                    class="text-sm underline text-medium-dark-tone inline-block mt-2">
                                    <?php echo $item['link']['title']; ?>

                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>

        <?php if($buttons): ?>
            <?php if (isset($component)) { $__componentOriginalf85ef01bc4c2fd81fa9733f50065289af24b8fe8 = $component; } ?>
<?php $component = App\View\Components\ButtonsList::resolve(['buttons' => $buttons,'className' => 'mt-10'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
        <?php endif; ?>
    </div>
    <div class="relative">
        <?php if($imagePositioning == 'image-left'): ?>
            <div class="thumbnail-styled bg-primary"></div>
        <?php else: ?>
            <div class="thumbnail-styled bg-accent"></div>
        <?php endif; ?>
        <figure
            class="<?php if($imagePositioning == 'image-left'): ?> lg:order-1 <?php endif; ?> <?php echo $aspect_ratio; ?> <?php if($aspect_ratio != 'auto'): ?> thumbnail-styled <?php endif; ?> rounded-lg">
            <?php if (isset($component)) { $__componentOriginalcf1fde6bef2907c23498101ce01c0f3f2594e0bd = $component; } ?>
<?php $component = App\View\Components\Image::resolve(['id' => $image,'className' => 'thumbnail'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Image::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcf1fde6bef2907c23498101ce01c0f3f2594e0bd)): ?>
<?php $component = $__componentOriginalcf1fde6bef2907c23498101ce01c0f3f2594e0bd; ?>
<?php unset($__componentOriginalcf1fde6bef2907c23498101ce01c0f3f2594e0bd); ?>
<?php endif; ?>
        </figure>

    </div>
</div>
<?php /**PATH /container/application/public/web/app/themes/devotion/resources/views/components/blocks/feature-sections/media-and-content.blade.php ENDPATH**/ ?>