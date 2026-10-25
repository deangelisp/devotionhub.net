<?php

add_action('none', function () {

    if (!isset($_GET['create-chapter'])) {
        return;
    }

    $args = [
        'post_type' => 'bible_chapter',
        'posts_per_page' => 1,
        'post_status' => 'publish',
        'meta_query' => [
            'relation' => 'OR',
            [
                'key' => 'page_builder_blocks',
                'compare' => 'NOT EXISTS',
            ],
            [
                'key' => 'page_builder_blocks',
                'value' => '', // Field is empty
                'compare' => '=',
            ],
            [
                'key' => 'page_builder_blocks',
                'value' => 'false', // Field is a string 'false'
                'compare' => '=',
            ],
            [
                'key' => 'page_builder_blocks',
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

            $postID = get_the_ID();
            // $chapter = get_field('chapter');

            // // $book get term book
            // $book = get_the_terms($postID, 'book');
            // $bookTitle = $book[0]->name;

            // new \App\View\Classes\ChapterContent($bookTitle, $chapter, $postID);

            $meta_description = get_field('meta_description', $postID);

        }
    } else {
        dd('No posts found');
    }

    wp_reset_postdata();

    $url = add_query_arg('create-chapter', $total, home_url());
    echo "<script>location.href = '{$url}';</script>";
    exit;
});
