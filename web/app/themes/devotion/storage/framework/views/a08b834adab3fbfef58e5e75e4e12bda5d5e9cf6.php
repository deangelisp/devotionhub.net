<?php if($headerCTA): ?>
    <span class="hidden md:inline-block">
        <a href="<?php echo $headerCTA['url']; ?>" target="<?php echo $headerCTA['target']; ?>"
            class="btn btn-primary  btn--highlight"><?php echo $headerCTA['title']; ?></a>
    </span>
<?php endif; ?>
<button id="header-menu" class="header-menu block lg:hidden text-primary ml-4 " aria-label="Mobile Menu">
    <?php echo e(get_svg('images.svg.icons.menu', 'w-14 md:w-12 ham hamRotate ham1 stroke-current')); ?>
</button>
<?php /**PATH /app/web/app/themes/devotion/resources/views/sections/header/actions.blade.php ENDPATH**/ ?>