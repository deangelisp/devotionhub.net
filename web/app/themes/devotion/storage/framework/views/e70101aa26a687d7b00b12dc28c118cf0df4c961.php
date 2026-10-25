<div class="<?php echo $className; ?>">
    <h2 class="text-base font-bold mb-3">The Bible Books</h2>
    <ul class="flex flex-wrap gap-1">
        <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="">
                <a class="block py-0.5 px-2 bg-gray-100 rounded hover:bg-gray-200 transition-all text-sm"
                    href="<?php echo $book['url']; ?>" class=""><?php echo $book['title']; ?></a>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php /**PATH /container/application/public/web/app/themes/devotion/resources/views/components/bible-books-cloud.blade.php ENDPATH**/ ?>