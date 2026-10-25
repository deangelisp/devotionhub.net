

<?php $__env->startSection('content'); ?>
    <?php while(have_posts()): ?>
        <?php (the_post()); ?>
        <article id="entry-post-content" class="max-w-2xl mx-auto px-4 md:px-0 mt-24 section-page ">
            <h1 class="text-5xl/snug font-semibold"><?php echo $title; ?></h1>
            <?php if($summary): ?>
                <p class="mt-4 text-lg text-gray-400 font-medium"><?php echo $summary; ?></p>
            <?php endif; ?>
            <div class="entry-content entry-post-content mt-7">
                <?php echo the_content(); ?>

            </div>
        </article>

        <?php if (isset($component)) { $__componentOriginala6f4a5d747a92464db72136f39af4609b0a7bfa8 = $component; } ?>
<?php $component = App\View\Components\RelatedPosts::resolve(['taxonomies' => $categories,'postid' => $postID] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('related-posts'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\RelatedPosts::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala6f4a5d747a92464db72136f39af4609b0a7bfa8)): ?>
<?php $component = $__componentOriginala6f4a5d747a92464db72136f39af4609b0a7bfa8; ?>
<?php unset($__componentOriginala6f4a5d747a92464db72136f39af4609b0a7bfa8); ?>
<?php endif; ?>
    <?php endwhile; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /container/application/public/web/app/themes/devotion/resources/views/single.blade.php ENDPATH**/ ?>