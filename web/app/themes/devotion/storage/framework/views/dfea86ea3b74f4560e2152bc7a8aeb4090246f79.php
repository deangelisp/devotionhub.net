<a href="<?php echo $url; ?>" class="inline-flex items-center gap-3">
    <?php if($side == 'left'): ?>
        <?php echo e(get_svg('images.svg.icons.arrow-left', ['class' => 'w-6 h-6 text-slate-500 flex-shrink-0'])); ?>
    <?php endif; ?>
    <span class="block">
        <span class="block font-semibold"><?php echo $title; ?></span>
        <span class="block"><?php echo $subtitle; ?></span>
    </span>
    <?php if($side == 'right'): ?>
        <?php echo e(get_svg('images.svg.icons.arrow-right', ['class' => 'w-6 h-6 text-slate-500 flex-shrink-0'])); ?>
    <?php endif; ?>
</a>
<?php /**PATH /container/application/public/web/app/themes/devotion/resources/views/components/button-pagination.blade.php ENDPATH**/ ?>