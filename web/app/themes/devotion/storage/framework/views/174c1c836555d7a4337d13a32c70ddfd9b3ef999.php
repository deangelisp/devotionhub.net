<footer id="main-footer" class="main-footer">
    <div class="container pt-6 pb-6 flex flex-col-reverse md:grid md:grid-cols-2 gap-12 md:gap-20">
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
        
        
        <div class="entry-content">
            <h2 class="text-2xl">Begin a New Journey Through the Bible</h2>
            <p class="mb-3 text-sm text-dark-tone ">Discover a deeper connection to your faith, one day at a time.</p>
            <p>Start a journey of spiritual growth and understanding with our<br /><span
                    class="bg-sky-600 py-1 px-2 rounded-md text-sky-50 font-medium">FREE 90-Day Bible Study
                    Course</span>.
                Receive a daily email with guided readings, reflections, and practical insights from Scripture. Explore
                the Bible in a way that fits into your daily routine, bringing wisdom, peace, and guidance along the
                way.</p>
            <p class="mt-4 md:mt-10"><a href="/bible-study/90-day-journey-through-the-bible-from-genesis-to-revelation/"
                    class="btn">Start Your Journey Today – <strong>It’s Free!</strong> </a></p>
        </div>
    </div>
    <?php echo $__env->make('sections.footer.copyright', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</footer>
<?php /**PATH /container/application/public/web/app/themes/devotion/resources/views/components/blocks/footer/footer3.blade.php ENDPATH**/ ?>