<?php
add_action('none', function () {
    if (!isset($_GET['create-verse-analisys'])) {
        return;
    }

    global $wpdb;

    $offset = $_GET['create-verse-analisys'];

    $query = "SELECT * FROM wp_dev_verse  WHERE excerpt = '' LIMIT 1 OFFSET {$offset}  ";

    $verse = $wpdb->get_row($query);

    // check if still have verses to analyze
    if (!$verse) {
        dd('No verses found');
    }

    if ($verse->excerpt) {
        dd('Verse already analyzed');
        // $offset++;
        // $url = add_query_arg('create-verse-analisys', $offset, home_url());
        // echo "<script>location.href = '{$url}';</script>";
        // exit;
    }

    $verse_id = $verse->verse_id;
    $verse = "{$verse->book} {$verse->chapter}:{$verse->verse}";

    $excerpt = new \App\View\Classes\VerseShortDescription($verse);
    $excerpt = $excerpt->excerpt;

    if (empty($excerpt)) {
        dd('EMPTY: ' . $verse);
    }

    $wpdb->update('wp_dev_verse', ['excerpt' => $excerpt], ['verse_id' => $verse_id]);

    // $offset++;
    $url = add_query_arg('create-verse-analisys', $offset, home_url());
    echo "<script>location.href = '{$url}';</script>";
    exit;
});
