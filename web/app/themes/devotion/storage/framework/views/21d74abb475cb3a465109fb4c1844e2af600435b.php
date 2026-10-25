<div class="section-page container block-bible-books pt-10 sm:pt-20 md:pt-28">
    <?php if (isset($component)) { $__componentOriginal1308504eb5783b613a93c2370aecf0317561937f = $component; } ?>
<?php $component = App\View\Components\Heading::resolve(['tag' => 'h1','className' => 'text-center lg:px-5 mb-4'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
    <div class="max-w-3xl text-center mb-14 mx-auto text-sm"><?php echo $content; ?></div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div
                class="flex gap-2 items-center border border-gray-100 p-2 rounded-sm relative hover:bg-gray-50 transition-all">
                <div>

                    <h3 class="text-lg"><?php echo $book['title']; ?></h3>
                    <p class="text-xs text-gray-500"><?php echo $book['description']; ?></p>
                </div>
                <img src="<?php echo $book['image']; ?>" alt="<?php echo $book['title']; ?>" width="150" height="150"
                    class="aspect-square object-cover flex-shrink-0 w-20 rounded overflow-hidden">

                <a href="<?php echo $book['url']; ?>" class="absolute top-0 left-0 w-full h-full">
                    <span class="sr-only">Read the Bible Book of <?php echo $book['title']; ?></span>
                </a>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

</div>
<?php /**PATH /container/application/public/web/app/themes/devotion/resources/views/components/blocks/cta-sections/bible-books.blade.php ENDPATH**/ ?>