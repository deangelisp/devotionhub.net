<?php if($media): ?>
    <script src="https://www.youtube.com/iframe_api"></script>
    <div class="mt-8 grid grid-cols-2 gap-3 verse-media-container">
        <?php $__currentLoopData = $media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div>
                <div class="verse-media-container-item aspect-reel overflow-hidden rounded-md thumbnail-frame">
                    <img src="<?php echo $item['thumbnail']; ?>" alt="<?php echo $item['title']; ?>" class="thumbnail" width="194"
                        height="335">

                    <div class="vignette">
                    </div>

                    <?php echo e(get_svg('images.svg.icons.youtube-short-logo', 'absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-16 h-16 youtube-logo')); ?>
                    <?php echo e(get_svg('images.svg.icons.youtube-short-play', 'absolute bottom-0 left-0 w-11 h-auto fill-white opacity-90')); ?>
                    <?php echo e(get_svg('images.svg.icons.youtube-short-name', 'absolute bottom-0.5 right-0.5 w-24 h-auto fill-white opacity-90')); ?>
                    <div id="youtube-player-<?php echo e($key); ?>" data-video-id="<?php echo $item['id']; ?>"
                        class="w-full h-full  youtube-player-item absolute left-0 top-0 cursor-pointer z-10"></div>
                </div>
                <?php if($displaytitle): ?>
                    <p class="text-sm font-semibold text-center mt-2">
                        <a href="<?php echo $item['url']; ?>"
                            class=" hover:text-blue-700 hover:underline"><?php echo $item['title']; ?></a>
                    </p>
                <?php endif; ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>
<?php /**PATH /container/application/public/web/app/themes/devotion/resources/views/components/verse-media-container.blade.php ENDPATH**/ ?>