<?php if($primaryNavigation): ?>
    <nav id="nav-primary" class="nav-primary transition-all relative block" aria-label="<?php echo wp_get_nav_menu_name('primary_navigation'); ?>">
        <ul class="nav-primary-loop max-w-none mx-0 flex flex-row items-center  font-medium">
            <?php $__currentLoopData = $primaryNavigation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li
                    class="nav-primary-loop-item menu-item relative first-nav mb-0 <?php if($item['children']): ?> has-children <?php endif; ?>">
                    <a href="<?php echo $item['url']; ?>" target="<?php echo $item['target']; ?>"
                        class="<?php echo $item['classes'] ?? ''; ?> inline-block px-3 py-2 w-full ">
                        <?php echo $item['title']; ?>

                        <?php if($item['children']): ?>
                            <span class="arrow-down ">
                                <?php echo e(get_svg('images.svg.icons.arrow-down', 'inline-block w-2.5 ml-1 transition-all')); ?>
                            </span>
                        <?php endif; ?>
                    </a>

                    <?php if($item['children']): ?>
                        <ul class="submenu absolute w-60 radius p-2 left-0 bg-white top-full border border-primary">
                            <?php $__currentLoopData = $item['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="menu-item">
                                    <a href="<?php echo $child['url']; ?>" target="<?php echo $item['target']; ?>"
                                        class="block py-2 px-4 menu-item-link radius <?php echo $child['classes'] ?? ''; ?> ">
                                        <?php echo $child['title']; ?>

                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>

                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </nav>
<?php endif; ?>
<?php /**PATH /container/application/public/web/app/themes/devotion/resources/views/sections/header/menu.blade.php ENDPATH**/ ?>