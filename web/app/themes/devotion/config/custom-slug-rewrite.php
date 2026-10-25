<?php

function register_bible_rewrite_rules()
{
    $books = get_books_schema();

    foreach ($books as $bookSlug => $book) {

        $bookID = $book['id'];
        add_rewrite_rule("^bible/{$bookSlug}/?$", "index.php?book_id={$bookID}", 'top');

        foreach ($book['chapters'] as $chapter) {
            $chapterNumber = $chapter['chapter'];
            $chapterID = $chapter['id'];
            add_rewrite_rule("^bible/{$bookSlug}/chapter-{$chapterNumber}/?$", "index.php?book_id={$bookID}&chapter={$chapterID}", 'top');

            $totalVerses = $chapter['verses'];

            for ($i = 1; $i <= $totalVerses; $i++) {
                add_rewrite_rule("^bible/{$bookSlug}/chapter-{$chapterNumber}/verse-{$i}/?$", "index.php?book_id={$bookID}&chapter={$chapterID}&verse_from={$i}", 'top');
            }

            // Range of verses
            add_rewrite_rule("^bible/{$bookSlug}/chapter-{$chapterNumber}/verses-(\d+)-(\d+)/?$", "index.php?book_id={$bookID}&chapter={$chapterID}&verse_from=\$matches[1]&verse_to=\$matches[2]", 'top');

            // for ($i = 1; $i <= $totalVerses; $i++) {
            //     for ($j = $i + 1; $j <= $totalVerses; $j++) {
            //         add_rewrite_rule("^bible/{$bookSlug}/chapter-{$chapterNumber}/verses-{$i}-{$j}/?$", "index.php?book_id={$bookID}&chapter={$chapterID}&verse_from={$i}&verse_to={$j}", 'top');
            //     }
            // }
        }
    }

    add_rewrite_rule('^bible-search/?$', 'index.php?bible_search=1', 'top');

    flush_rewrite_rules();
}

// Add Custom Query Variables
add_filter('query_vars', function ($vars) {
    $vars[] = 'book_id';
    $vars[] = 'chapter';
    $vars[] = 'verse_from';
    $vars[] = 'verse_to';
    $vars[] = 'bible_search';

    return $vars;
});

// Handle Template Redirection
add_action('pre_get_posts', function ($query) {

    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    $bookID = get_query_var('book_id');
    $chapterID = get_query_var('chapter');
    $vars = $query->query_vars;

    if ($bookID && $chapterID) {

        $query->is_single = true;
        $query->is_archive = false;
        $query->is_page = false;
        $query->is_singular = true;
        $query->is_home = false;
        $query->set('post_type', 'bible_chapter');
        $query->set('p', $chapterID);

    } else if ($bookID) {
        $query->set('post_type', 'bible_chapter');
        $query->is_post_type_archive = true;
        $query->is_archive = true;
        $query->is_page = false;
        $query->is_single = false;
        $query->is_singular = false;
        $query->is_home = false;
    }

});

add_action('wp_loaded', function () {
    global $wp_rewrite;
    $wp_rewrite->wp_rewrite_rules();

    if (!isset($wp_rewrite->rules['^bible/1-chronicles/chapter-1/?$'])) {
        register_bible_rewrite_rules();

    }
}, 100);
