<?php

add_action('wp_head', function () {
    $breadcrumb = [
        'Bible' => '/the-books-of-the-bible/',
    ];

    $bookID = get_query_var('book_id');
    $chapter = get_query_var('chapter');
    $verseFrom = get_query_var('verse_from');
    $verseTo = get_query_var('verse_to');

    $url = '/bible/';

    if ($bookID) {
        $book = get_term($bookID, 'book');
        $url .= $book->slug . '/';
        $breadcrumb[$book->name] = $url;
    }

    if ($chapter) {
        $title = get_field('chapter', $chapter);

        $url .= 'chapter-' . $title . '/';
        $breadcrumb["Chapter {$title}"] = $url;
    }

    if ($verseTo) {
        $url .= "verses-{$verseFrom}-{$verseTo}/";
        $breadcrumb["Verses {$verseFrom}-{$verseTo}"] = $url;
    } else if ($verseFrom) {
        $url .= "verse-{$verseFrom}/";
        $breadcrumb["Verse {$verseFrom}"] = $url;
    }

    if (count($breadcrumb) > 1) {
        echo getBreadcrumbStructuredData($breadcrumb);
    }
});
