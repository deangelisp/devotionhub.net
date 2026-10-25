<div id="mobile-menu" class="mobile-menu z-50 transition-3s lg:hidden">
    <div class="container pt-8 max-w-lg">
        <div class="mt-10 md:mt-16">
            <?php if($primaryNavigation): ?>
                <nav id="mobile-menu-nav" class="mobile-menu-nav transition-all relative block ">
                    <ul>
                        <?php $__currentLoopData = $primaryNavigation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li
                                class="mobile-menu-loop-item  first-nav mb-0 <?php if($item['children']): ?> has-children <?php endif; ?>">

                                <?php if($item['children']): ?>
                                    <button
                                        class="flex justify-between items-center px-3 py-2 w-full mobile-menu-open-submenu ">
                                        <?php echo $item['title']; ?>


                                        <span class="flex items-center gap-2 text-sm md:text-lg">
                                            <span>View Submenu</span>
                                            <?php echo e(get_svg('images.svg.icons.arrow-right', 'inline-block w-2 ml-1 transition-all')); ?>
                                        </span>
                                    </button>
                                    <ul class="mobile-menu-submenu ">
                                        <button class="mobile-menu-close-submenu flex items-center px-3 py-2 w-full ">
                                            <?php echo e(get_svg('images.svg.icons.arrow-left', 'inline-block w-2 mr-2 transition-all')); ?>
                                            <span class="text-sm md:text-lg">Close Submenu</span>
                                        </button>
                                        <a href="<?php echo $item['url']; ?>" target="<?php echo $item['target']; ?>"
                                            class="<?php echo $item['classes'] ?? ''; ?> inline-block px-3 py-2 w-full ">
                                            <?php echo $item['title']; ?>

                                        </a>

                                        <?php $__currentLoopData = $item['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="mobile-menu-submenu-item ">
                                                <a href="<?php echo $child['url']; ?>" target="<?php echo $child['target']; ?>"
                                                    class="<?php echo $child['classes'] ?? ''; ?> inline-block px-3 py-2 w-full ">
                                                    <?php echo $child['title']; ?>

                                                </a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                <?php else: ?>
                                    <a href="<?php echo $item['url']; ?>" target="<?php echo $item['target']; ?>"
                                        class="<?php echo $item['classes'] ?? ''; ?> inline-block px-3 py-2 w-full ">
                                        <?php echo $item['title']; ?>

                                    </a>
                                <?php endif; ?>

                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
    </div>

    <?php if(isset($headerCTA['url'])): ?>
        <a href="<?php echo $headerCTA['url']; ?>" target="<?php echo $headerCTA['target']; ?>"
            class="btn btn-primary absolute bottom-3 left-3 right-3"><?php echo $headerCTA['title']; ?></a>
    <?php endif; ?>
</div>
<?php /**PATH /app/web/app/themes/devotion/resources/views/sections/header/mobile-menu.blade.php ENDPATH**/ ?>