<?php
add_action('none', function () {
    if (!isset($_GET['create-meta-description'])) {
        return;
    }
    $args = [
        'post_type' => 'bible_chapter',
        'posts_per_page' => 1,
        'post_status' => 'publish',
        'meta_query' => [
            'relation' => 'OR',
            [
                'key' => 'meta_description',
                'compare' => 'NOT EXISTS',
            ],
            [
                'key' => 'meta_description',
                'value' => '', // Field is empty
                'compare' => '=',
            ],
            [
                'key' => 'meta_description',
                'value' => 'false', // Field is a string 'false'
                'compare' => '=',
            ],
            [
                'key' => 'meta_description',
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

            $chapter = get_field('chapter');
            $postID = get_the_ID();

            // $book get term book
            $book = get_the_terms($postID, 'book');
            $bookTitle = $book[0]->name;

            $description = new \App\View\Classes\MetaDescription($bookTitle, $chapter);

            update_field('meta_description', $description->data, $postID);

        }
    } else {
        dd('No posts found');
    }

    wp_reset_postdata();

    $url = add_query_arg('create-meta-description', $total, home_url());
    echo "<script>location.href = '{$url}';</script>";
    exit;
});
