<?php if($background): ?>
    <div class="absolute inset-0 thumbnail-frame <?php if($parallax): ?> bg-fixed <?php endif; ?> bg-cover bg-center
        <?php if($type == 'color'): ?> <?php echo $background; ?> <?php endif; ?>
        "
        <?php if($type == 'image'): ?> style="background-image: url('<?php echo $background; ?>');" <?php endif; ?>>
        <?php if($type == 'video'): ?>
            <video class="thumbnail" autoplay loop muted playsinline>
                <source src="<?php echo e($background); ?>" type="video/mp4">
            </video>
        <?php endif; ?>
    </div>

    
    <?php if($type != 'color'): ?>
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH /container/application/public/web/app/themes/devotion/resources/views/components/background-block.blade.php ENDPATH**/ ?>