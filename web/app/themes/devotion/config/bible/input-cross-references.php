<?php

function parseBibleReference($reference)
{

    $books = [
        'Gen' => 'Genesis',
        'Exod' => 'Exodus',
        'Lev' => 'Leviticus',
        'Num' => 'Numbers',
        'Deut' => 'Deuteronomy',
        'Josh' => 'Joshua',
        'Judg' => 'Judges',
        'Ruth' => 'Ruth',
        '1Sam' => '1 Samuel',
        '2Sam' => '2 Samuel',
        '1Kgs' => '1 Kings',
        '2Kgs' => '2 Kings',
        '1Chr' => '1 Chronicles',
        '2Chr' => '2 Chronicles',
        'Ezra' => 'Ezra',
        'Neh' => 'Nehemiah',
        'Esth' => 'Esther',
        'Job' => 'Job',
        'Ps' => 'Psalms',
        'Prov' => 'Proverbs',
        'Eccl' => 'Ecclesiastes',
        'Song' => 'Song of Songs',
        'Isa' => 'Isaiah',
        'Jer' => 'Jeremiah',
        'Lam' => 'Lamentations',
        'Ezek' => 'Ezekiel',
        'Dan' => 'Daniel',
        'Hos' => 'Hosea',
        'Joel' => 'Joel',
        'Amos' => 'Amos',
        'Obad' => 'Obadiah',
        'Jonah' => 'Jonah',
        'Mic' => 'Micah',
        'Nah' => 'Nahum',
        'Hab' => 'Habakkuk',
        'Zeph' => 'Zephaniah',
        'Hag' => 'Haggai',
        'Zech' => 'Zechariah',
        'Mal' => 'Malachi',
        'Matt' => 'Matthew',
        'Mark' => 'Mark',
        'Luke' => 'Luke',
        'John' => 'John',
        'Acts' => 'Acts',
        'Rom' => 'Romans',
        '1Cor' => '1 Corinthians',
        '2Cor' => '2 Corinthians',
        'Gal' => 'Galatians',
        'Eph' => 'Ephesians',
        'Phil' => 'Philippians',
        'Col' => 'Colossians',
        '1Thess' => '1 Thessalonians',
        '2Thess' => '2 Thessalonians',
        '1Tim' => '1 Timothy',
        '2Tim' => '2 Timothy',
        'Titus' => 'Titus',
        'Phlm' => 'Philemon',
        'Heb' => 'Hebrews',
        'Jas' => 'James',
        '1Pet' => '1 Peter',
        '2Pet' => '2 Peter',
        '1John' => '1 John',
        '2John' => '2 John',
        '3John' => '3 John',
        'Jude' => 'Jude',
        'Rev' => 'Revelation',
    ];

    $pattern = '/^(\d?[A-Za-z]+)\.(\d+)\.(\d+)(?:-(\d?[A-Za-z]+)\.(\d+)\.(\d+))?$/';
    $result = [];

    if (preg_match($pattern, $reference, $matches)) {

        $result['Book'] = $books[$matches[1]];
        $result['Chapter'] = $matches[2];

        $book_id = get_book_by_title($result['Book']);

        if (!$book_id) {
            dd($result['Book'], $reference, 'A');
        }

        $book_id = $book_id['id'];
        $chapter_id = get_chapter_by_title($book_id, $result['Chapter']);

        if (!$chapter_id) {
            dd($result['Chapter'], $reference, 'B');
        }

        $chapter_id = $chapter_id['id'];

        $result['BookId'] = $book_id;
        $result['ChapterId'] = $chapter_id;

        if (isset($matches[4])) { // If there's a second part of the range
            if ($matches[1] === $matches[4]) { // Same book
                $result['Verse'] = $matches[3] . '-' . $matches[6];
            } else { // Different book, include full references
                $result['Verse'] = $matches[3] . '-' . $matches[4] . '.' . $matches[5] . '.' . $matches[6];
            }
        } else { // Single verse
            $result['Verse'] = $matches[3];
        }
    }

    return $result;
}

function insertVerse($book_id, $chapter_id, $book_title, $chapter_title, $verse_text)
{

    global $wpdb;

    $insert_result = $wpdb->insert(
        'wp_dev_verse',
        [
            'book_id' => $book_id,
            'chapter_id' => $chapter_id,
            'book' => $book_title,
            'chapter' => $chapter_title,
            'verse' => $verse_text,
        ],
        [
            '%d', // Data type for book_id (integer)
            '%d', // Data type for chapter_id (integer)
            '%s', // Data type for book (string)
            '%s', // Data type for chapter (string)
            '%s', // Data type for verse (string)
        ]
    );

    if ($insert_result === false) {
        // check if the error is due to duplicate entry
        if (strpos($wpdb->last_error, 'Duplicate entry') !== false) {
            // return the id of the existing verse
            $verse = $wpdb->get_row("SELECT * FROM wp_dev_verse WHERE book_id = $book_id AND chapter_id = $chapter_id AND verse = '$verse_text'");

            return $verse->verse_id;
        }

        dd($wpdb->last_error, $verse_id, $ref_verse_id, [
            'book_id' => $book_id,
            'chapter_id' => $chapter_id,
            'book' => $book_title,
            'chapter' => $chapter_title,
            'verse' => $verse_text,
        ], 'C');
    }

    return $wpdb->insert_id;
}

function insetRelationship($verse_id, $ref_verse_id)
{
    global $wpdb;

    $insert_result = $wpdb->insert(
        'wp_dev_verse_relationship',
        [
            'verse_id_1' => $verse_id,
            'verse_id_2' => $ref_verse_id,
        ],
        [
            '%d', // Data type for verse_id (integer)
            '%d', // Data type for ref_verse_id (integer)
        ]
    );

    if ($insert_result === false) {

        if (strpos($wpdb->last_error, 'Duplicate relationship') !== false) {
            return;
        }

        dd($wpdb->last_error, $verse_id, $ref_verse_id, 'D');
    }

    return $wpdb->insert_id;
}

add_action('none', function () {
    global $wpdb;

    if (!isset($_GET['input-cross-reference'])) {
        return;
    }

    // read the csv file from uploads
    $wp_upload_dir = wp_upload_dir();
    $file = $wp_upload_dir['basedir'] . '/cross_references.csv';

    if (!file_exists($file)) {
        dd('File not found');
    }

    $handle = fopen($file, 'r');

    fgetcsv($handle);

    $batchSize = 5000;
    $offset = intval($_GET['input-cross-reference']) * $batchSize;
    $counter = 0;

    while ($counter < $offset && fgetcsv($handle) !== false) {
        $counter++;
    }

    $counter = 0;

    while (($data = fgetcsv($handle)) !== false) {

        // skip the first row

        $from = $data[0];
        $to = $data[1];

        $from_parsed = parseBibleReference($from);
        $to_parsed = parseBibleReference($to);

        if (!isset($from_parsed['BookId'])) {
            dd($from_parsed, $from, 'F');
        }

        if (!isset($to_parsed['BookId'])) {
            dd($to_parsed, $to, 'H');
        }

        $from_id = insertVerse($from_parsed['BookId'], $from_parsed['ChapterId'], $from_parsed['Book'], $from_parsed['Chapter'], $from_parsed['Verse']);
        $to_id = insertVerse($to_parsed['BookId'], $to_parsed['ChapterId'], $to_parsed['Book'], $to_parsed['Chapter'], $to_parsed['Verse']);

        insetRelationship($from_id, $to_id);
        $counter++;

        if ($counter >= $batchSize) {
            break;
        }
    }

    fclose($handle);

    if ($counter < $batchSize) {
        dd('Done');
    } else {
        $url = add_query_arg('input-cross-reference', $_GET['input-cross-reference'] + 1);
        echo "<script>location.href = '$url';</script>";
        exit;
    }

});
