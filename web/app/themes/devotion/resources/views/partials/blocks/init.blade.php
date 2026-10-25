@foreach ($blocks as $id => $block)
    @php

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
    @endphp
@endforeach
