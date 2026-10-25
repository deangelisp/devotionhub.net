<?php if($query->have_posts()): ?>
    <div id="block-pos-<?php echo $id; ?>" class="section-page container">
        <div class="max-w-3xl mx-auto">
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
                <div class="entry-content mt-8">
                    <?php echo $content; ?>

                </div>
            <?php endif; ?>
        </div>


        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-12 mt-20">
            <?php while($query->have_posts()): ?>
                <?php ($query->the_post()); ?>
                <?php if (isset($component)) { $__componentOriginale237821a897990d1e493da54d4a9b6c85c17e344 = $component; } ?>
<?php $component = App\View\Components\CardPost::resolve(['title' => get_the_title(),'excerpt' => get_the_excerpt(),'link' => get_the_permalink(),'postid' => get_the_ID(),'categories' => get_the_category()] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('card-post'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\CardPost::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale237821a897990d1e493da54d4a9b6c85c17e344)): ?>
<?php $component = $__componentOriginale237821a897990d1e493da54d4a9b6c85c17e344; ?>
<?php unset($__componentOriginale237821a897990d1e493da54d4a9b6c85c17e344); ?>
<?php endif; ?>
            <?php endwhile; ?>
            <?php (wp_reset_postdata()); ?>

        </div>
        <?php if($buttons): ?>
            <?php if (isset($component)) { $__componentOriginalf85ef01bc4c2fd81fa9733f50065289af24b8fe8 = $component; } ?>
<?php $component = App\View\Components\ButtonsList::resolve(['buttons' => $buttons,'className' => 'mt-10 justify-center'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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

<?php endif; ?>
<?php /**PATH /container/application/public/web/app/themes/devotion/resources/views/components/blocks/feature-sections/dynamic-post-grid.blade.php ENDPATH**/ ?>