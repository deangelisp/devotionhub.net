<?php

function get_books_schema()
{
    $schema = get_field('books_schema', 'option');

    if (!$schema) {
        $schema = create_books_schema();
    }

    return $schema;
}

function create_books_schema()
{

    $args = [
        'post_type' => 'bible_chapter',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC',
    ];

    $query = new WP_Query($args);

    $schema = [];
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            $chapter_id = get_the_ID();

            // Book
            $term = get_the_terms($chapter_id, 'book')[0];
            $book = $term->name;
            $book = sanitize_title($book);
            $order = get_field('book_order', $term);

            // Chapter
            $chapter = get_field('chapter', $chapter_id);

            // Verses
            $versesQty = (int) get_field('total_verses', $chapter_id);

            $item = [
                'id' => $chapter_id,
                'chapter' => $chapter,
                'verses' => $versesQty,
                'title' => get_field('title', $chapter_id),
            ];

            if (!isset($schema[$book])) {
                $schema[$book] = [
                    'id' => $term->term_id,
                    'title' => $term->name,
                    'slug' => $book,
                    'chapters' => [],
                    'order' => $order,
                ];
            }

            $schema[$book]['chapters'][] = $item;
        }
    }

    wp_reset_postdata();

    update_field('books_schema', $schema, 'option');

    update_option('latest_bible_rewrite_rules_version', time());

    return $schema;
}

add_action('init', function () {

});

add_action('save_post', 'refresh_all_schemas_when_post_updates', 10, 3);
function refresh_all_schemas_when_post_updates($post_id, $post, $update)
{
    if ($post->post_type == 'bible_chapter') {
        create_books_schema();
    }
}
