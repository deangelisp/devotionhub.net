<?php if($terms): ?>
    <div class="post-terms text-sm mb-2">
        <?php $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo $term['link']; ?>" class="post-term hover:underline"><?php echo $term['name']; ?></a>

            <?php if(!$loop->last): ?>
                ,
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>
<?php /**PATH /container/application/public/web/app/themes/devotion/resources/views/components/terms-list.blade.php ENDPATH**/ ?>