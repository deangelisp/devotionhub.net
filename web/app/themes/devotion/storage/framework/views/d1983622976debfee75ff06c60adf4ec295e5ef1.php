<div
    class="border-t border-medium-tone  container flex justify-center sm:justify-between items-center sm:items-end flex-col sm:flex-row py-4 text-xs  ">
    <div>
        <p class="mb-4 sm:mb-0"><?php echo $copyright; ?></p>
    </div>
    <?php echo $__env->make('sections.footer.legend-stamp', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php /**PATH /container/application/public/web/app/themes/devotion/resources/views/sections/footer/copyright.blade.php ENDPATH**/ ?>