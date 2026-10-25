<?php

add_action('init', function () {
    global $wpdb;

    if (!isset($_GET['cross-reference'])) {
        return;
    }

    return false;

    $args = [
        'post_type' => 'bible_chapter',
        'posts_per_page' => 1,
        'post_status' => 'publish',
        'meta_query' => [
            'relation' => 'OR',
            [
                'key' => 'cross_reference_created',
                'compare' => 'NOT EXISTS',
            ],
            [
                'key' => 'cross_reference_created',
                'value' => '', // Field is empty
                'compare' => '=',
            ],
            [
                'key' => 'cross_reference_created',
                'value' => 'false', // Field is a string 'false'
                'compare' => '=',
            ],
            [
                'key' => 'cross_reference_created',
                'value' => false, // Field is actually stored as false
                'compare' => '=',
            ],
        ],
    ];

    $query = new WP_Query($args);

    $total = $query->found_posts;

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            $chapter_id = get_the_ID();

            // $book get term book
            $book = get_the_terms($chapter_id, 'book');
            $book_title = $book[0]->name;
            $book_id = $book[0]->term_id;
            $chapter_title = get_field('chapter');

            new \App\View\Classes\CrossReference($book_title, $chapter_title, $book_id, $chapter_id);

            update_meta($chapter_id, 'cross_reference_created', true);

            dd($book_title, $chapter_title, $book_id, $chapter_id);
        }
    } else {
        dd('No posts found');
    }

    wp_reset_postdata();

    // $url = add_query_arg('cross-reference', $total, home_url());
    // echo "<script>location.href = '{$url}';</script>";
    // exit;
});
