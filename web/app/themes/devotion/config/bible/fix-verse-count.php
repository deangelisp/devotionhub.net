<?php

add_action('none', function () {

    if (!isset($_GET['fix-verse-count-offeset'])) {
        return;
    }

    $offeset = $_GET['fix-verse-count-offeset'];
    $per_page = 100;

    $args = [
        'post_type' => 'bible_chapter',
        'posts_per_page' => $per_page,
        'post_status' => 'publish',
        'offset' => $offeset,
    ];

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            $postID = get_the_ID();
            $verses = get_field('verses');

            $last_verse = end($verses);

            if (isset($last_verse['verse']) && !empty(isset($last_verse['verse']))) {
                $total_verses = $last_verse['verse'];
                update_field('total_verses', $total_verses, $postID);
            } else {
                dd("No verses found for post ID: $postID");
            }

        }
    } else {
        dd('No posts found');
    }

    $offeset += $per_page;

    echo "Next offset: $offeset\n";

    echo "<script>window.location.href = '/wp-admin/?fix-verse-count-offeset=$offeset';</script>";
    exit;
});
