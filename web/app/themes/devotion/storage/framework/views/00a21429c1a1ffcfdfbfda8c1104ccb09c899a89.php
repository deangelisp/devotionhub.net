<?php $__currentLoopData = $blocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $block): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php

        if (!is_array($block) || !isset($block['acf_fc_layout'])) {
            continue;
        }

        $category = $block['block_category_name'];
        $componentClass =
            'App\\View\\Components\\Blocks\\' .
            "$category\\" .
            str_replace(' ', '', ucwords(str_replace('_', ' ', $block['acf_fc_layout'])));

        if (class_exists($componentClass)) {
            $component = new $componentClass($id, $block);
            echo $component->render();
        }
    ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /app/web/app/themes/devotion/resources/views/partials/blocks/init.blade.php ENDPATH**/ ?>