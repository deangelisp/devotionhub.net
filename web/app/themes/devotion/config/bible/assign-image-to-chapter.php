<?php
add_action('init', function () {

    if (!isset($_GET['assign-image-to-chapter'])) {
        return;
    }

    $args = array(
        'post_type' => 'bible_chapter',
        'posts_per_page' => 1,
        'post_status' => 'publish',

        // post wtihout image
        'meta_query' => array(
            array(
                'key' => '_thumbnail_id',
                'compare' => 'NOT EXISTS',
            ),
        ),

    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            $post_id = get_the_ID();

            $chapter = get_field('chapter', $post_id);

            $term_book = get_the_terms($post_id, 'book');

            $book = $term_book[0]->slug;

            $image_name = "{$book}-chapter-{$chapter}";

            $image_args = array(
                'post_type' => 'attachment',
                'posts_per_page' => 1,
                'post_status' => 'inherit',
                'meta_query' => array(
                    array(
                        'key' => '_wp_attached_file',
                        'value' => $image_name,
                        'compare' => 'LIKE',
                    ),
                ),
            );

            $images = get_posts($image_args);

            if ($images) {
                $image = $images[0];

                $image_id = $image->ID;

                set_post_thumbnail($post_id, $image_id);

            } else {
                dd("No image found for chapter {$chapter} of {$book}");
            }

        }
    } else {
        dd('No post found');
    }

    wp_reset_postdata();

    $total = $query->found_posts;

    $url = add_query_arg('assign-image-to-chapter', $total, home_url());
    echo "<script>location.href = '{$url}';</script>";
    exit;

});
