<?php

add_action('init', function () {
    if (isset($_GET['export-extradata'])) {

        $data = [];

        $args = [
            'post_type' => 'extra_data',
            'posts_per_page' => -1,
        ];

        $query = new WP_Query($args);

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();

                $passage = get_field('passage');

                $data[] = $passage;
            }
        }

        // remove duplicates
        $data = array_unique($data);

        $data = implode("\n", $data);

        header('Content-Type: text/plain');
        // header('Content-Disposition: attachment; filename="extradata.txt"');

        echo $data;
        exit;
    }
});
