<?php

function add_custom_meta_tags()
{
    $bookID = get_query_var('book_id');
    $chapterID = get_query_var('chapter');
    $verseFrom = get_query_var('verse_from');
    $verseTo = get_query_var('verse_to');
    $verse = false;

    $bookTitle = '';
    $chapter = '';
    $description = false;
    $thumbnail = false;
    $siteName = get_bloginfo('name');

    if ($bookID) {
        $book = getBookFromSchema($bookID);
        $bookTitle = $book['title'];
    }

    if ($chapterID) {
        $chapter = get_field('chapter', $chapterID);
    }

    if ($verseTo) {
        $verse = get_post_by_title("{$bookTitle} {$chapter}:{$verseFrom}-{$verseTo}", 'bible_verse');

        $description = "Discover the profound teachings of {$bookTitle} Chapter {$chapter}, Verses {$verseFrom}-{$verseTo}. Join {$siteName} for in-depth Bible study and spiritual growth.";
    }

    if (!$description && $verseFrom) {

        $verse = get_post_by_title("{$bookTitle} {$chapter}:{$verseFrom}", 'bible_verse');

        $description = "Explore the meaning and significance of {$bookTitle} {$chapter}:{$verseFrom} on {$siteName}. Join us for a focused study on this impactful verse and enrich your spiritual journey.";
    }

    if (isset($verse->ID)) {
        $attachment_id = get_field('og_image', $verse->ID);

        if ($attachment_id) {
            $thumbnail = wp_get_attachment_image_url($attachment_id, 'large');
        }
    }

    if (!$description && $chapterID) {
        // $description = "Delve into the teachings of {$bookTitle} Chapter {$chapter} on {$siteName}. Join us for a comprehensive study of this chapter to gain deeper understanding and spiritual insights.";
        $description = get_field('meta_description', $chapterID);
    }

    if (!$description && $bookID) {
        $term = get_term($bookID, 'book');
        $description = $term->description;
        $thumbnail = get_field('cover', "book_{$bookID}");
        $thumbnail = wp_get_attachment_image_url($thumbnail, 'large');
    }

    if (is_page()) {
        $description = get_the_excerpt();
    }

    if (is_single() && !$description) {
        $description = get_the_excerpt();
    }

    if (!$thumbnail) {
        if (has_post_thumbnail()) {
            $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'large');
        } else {
            $attachment_id = get_field('settings_general_default_thumbnail', 'option');
            $thumbnail = wp_get_attachment_image_url($attachment_id, 'large');
        }
    }

    // if is taxonomies
    if (is_category() || is_tag()) {
        $term = get_queried_object();
        $description = $term->description;

        $thumbnail = false;

    }

    if ($description) {
        global $wp;

        $title = wp_get_document_title();

        $current_url = home_url(add_query_arg(array(), $wp->request)) . '/';

        echo "\n";
        echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
        // echo '<meta name="keywords" content="' . esc_attr($keywords) . '">' . "\n";
        // echo '<meta name="author" content="' . get_bloginfo('name') . '">' . "\n";

        // // Add Open Graph meta tags for better social sharing
        echo '<meta property="og:title" content="' . $title . '">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
        echo '<meta property="og:type" content="website">' . "\n";
        echo '<meta property="og:url" content="' . $current_url . '">' . "\n";
        echo '<meta property="og:site_name" content="' . $siteName . '">' . "\n";

        if ($thumbnail) {
            echo '<meta property="og:image" content="' . $thumbnail . '">' . "\n";
        }

        // // Add Twitter Card meta tags for better social sharing
        // echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
        echo '<meta name="twitter:title" content="' . $title . '">' . "\n";
        echo '<meta name="twitter:description" content="' . esc_attr($description) . '">' . "\n";
        if ($thumbnail) {
            echo '<meta name="twitter:image" content="' . $thumbnail . '">' . "\n";
        }
    }
}

add_action('wp_head', 'add_custom_meta_tags');

// Handle Dynamic Title
add_filter('pre_get_document_title', function ($title) {

    if (is_admin()) {
        return $title;
    }

    $bookID = get_query_var('book_id');
    $chapterID = get_query_var('chapter');
    $verseFrom = get_query_var('verse_from');
    $verseTo = get_query_var('verse_to');

    $bookTitle = '';
    $chapter = '';
    $siteName = get_bloginfo('name');

    if ($bookID) {
        $book = getBookFromSchema($bookID);
        $bookTitle = $book['title'];
    }

    if ($chapterID) {
        $chapter = get_field('chapter', $chapterID);
    }

    if ($verseTo) {
        $title = "{$bookTitle} Chapter {$chapter}: Verses {$verseFrom}-{$verseTo} - In-Depth Bible Study | $siteName";
    }

    if (!$verseTo && $verseFrom) {
        $title = "{$bookTitle} {$chapter}:{$verseFrom} - Deep Dive into a Single Verse | $siteName";
    }

    if (!$verseFrom && $chapterID) {
        $title = "{$bookTitle} Chapter {$chapter} - Detailed Bible Study and Analysis | $siteName";
    }

    if (!$chapterID && $bookID) {
        $subtitle = get_field('subtitle', "book_{$bookID}");
        $title = "{$bookTitle} - {$subtitle} | $siteName";
    }

    if (is_category() || is_tag()) {
        $term = get_queried_object();

        $title = ' | ' . $siteName;

        if (is_category()) {
            $title = $term->name . ' Archive' . $title;
        } else {
            $title = $term->name . ' Post Tagged ' . $title;
        }
    }

    return $title;
}, 101, 1);

function add_custom_meta_description()
{
    if (is_singular()) {
        global $post;

        $meta_description = get_post_meta($post->ID, 'custom_meta_description', true);

        if (empty($meta_description)) {
            $meta_description = $post->post_excerpt;
        }

        echo '<meta name="description" content="' . $meta_description . '">' . "\n";

    }
}
add_action('wp_head', 'add_custom_meta_description');
