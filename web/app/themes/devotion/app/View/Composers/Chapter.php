<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Chapter extends Composer
{

    public $blocks;

    protected static $views = [
        'single-bible_chapter',
    ];

    public function with()
    {

        $bookID = get_query_var('book_id');
        $chapter = get_query_var('chapter');
        $verseFrom = get_query_var('verse_from');
        $verseTo = get_query_var('verse_to');
        $pageType = $this->getPageType($verseFrom, $verseTo);

        $bookTitle = $this->getBookTitle($bookID);
        $chapterTitle = $this->getChapterTitle($chapter);
        $title = $this->title($bookTitle, $chapterTitle, $verseFrom, $verseTo);

        return [
            'title' => $title,
            'verses' => $this->verses($chapter, $verseFrom, $verseTo),
            'notes' => $this->notes($pageType, $chapter),
            'paragraph' => $this->paragraph($pageType, $chapter),
            'subtitle' => $this->subtitle($pageType, $chapter),
            'bookTitle' => $bookTitle,
            'chapter' => get_field('chapter', $chapter),
            'verseFrom' => $verseFrom,
            'chapterUrl' => $this->chapterUrl(),
            'previousLink' => $this->previousLink($bookID, $bookTitle, $chapterTitle, $verseFrom),
            'nextLink' => $this->nextLink($bookID, $bookTitle, $chapterTitle, $verseFrom),
            'crossReferences' => $this->crossReferences($chapter, $verseFrom, $verseTo),
            'youtubeMedia' => $this->youtubeMedia($chapter, $title, $verseFrom),
            'blocks' => $this->blocks($pageType, $title),
            'verseShortDescription' => $this->verseShortDescription($chapter, $verseFrom, $verseTo),
            'thumbnail' => $this->thumbnail($verseFrom, $title),
        ];
    }

    private function title($bookTitle, $chapter, $verseFrom, $verseTo)
    {
        $title = "$bookTitle $chapter";

        if ($verseFrom) {
            $title .= ":$verseFrom";

            if ($verseTo) {
                $title .= "-$verseTo";
            }
        }

        return $title;

    }

    private function verses($postID, $verseFrom, $verseTo)
    {

        $verses = get_field('verses', $postID);

        if ($verseFrom) {
            $verseTo = $verseTo ? $verseTo : $verseFrom;
            $verses = array_filter($verses, function ($verse) use ($verseFrom, $verseTo) {
                return $verse['verse'] >= $verseFrom && $verse['verse'] <= $verseTo;
            });
        }

        // sortby verse
        // usort($verses, function ($a, $b) {
        //     return $a['verse'] <=> $b['verse'];
        // });

        return $verses;
    }

    private function notes($pageType, $chapter)
    {

        if ($pageType != 'chapter') {
            return false;
        }

        return get_field('notes', $chapter);
    }

    private function paragraph($pageType, $chapter)
    {

        if ($pageType != 'chapter') {
            return false;
        }

        return get_field('paragraph', $chapter);
    }

    private function subtitle($pageType, $chapter)
    {

        if ($pageType != 'chapter') {
            return false;
        }

        return get_field('title', $chapter);
    }

    private function getBookTitle($bookID)
    {
        $term = get_term($bookID, 'book');

        return $term->name;
    }

    private function getChapterTitle($chapter)
    {
        return get_field('chapter', $chapter);
    }

    private function chapterUrl()
    {
        // get the current url
        $url = home_url(add_query_arg([], $GLOBALS['wp']->request));

        // remove from verse to the end of url
        $url = preg_replace('/verses?-\d+.*$/', '', $url);

        return $url;
    }

    private function nextLink($bookID, $bookTitle, $chapter, $verseFrom)
    {
        // dd($bookID, $bookTitle, $chapter, $verseFrom);

        if (!$verseFrom) {
            $currentURl = '/' . $GLOBALS['wp']->request . '/';

            $nextChapter = getNextChapter($bookID, $chapter);

            if ($nextChapter) {

                if (strpos($currentURl, 'chapter')) {
                    $newURL = str_replace("chapter-{$chapter}", "chapter-{$nextChapter}", $currentURl);
                } else {
                    $newURL = $currentURl . "chapter-{$nextChapter}/";
                }

                return [
                    'url' => $newURL,
                    'title' => "Next Chapter",
                    'subtitle' => "$bookTitle {$nextChapter}",
                ];
            }
        }

        $nextBook = getNextBook($bookID);

        if ($nextBook) {
            return [
                'url' => $nextBook['url'],
                'title' => "Next Book",
                'subtitle' => $nextBook['title'],
            ];
        }
    }

    private function previousLink($bookID, $bookTitle, $chapter, $verseFrom)
    {
        if (!$verseFrom) {
            $currentURl = '/' . $GLOBALS['wp']->request . '/';

            $previousChapter = getPreviousChapter($chapter);

            if ($previousChapter) {

                $newURL = str_replace("chapter-{$chapter}", "chapter-{$previousChapter}", $currentURl);

                return [
                    'url' => $newURL,
                    'title' => "Previous Chapter",
                    'subtitle' => "$bookTitle {$previousChapter}",
                ];
            }
        }

        $previousBook = getPreviousBook($bookID);

        if ($previousBook) {
            return [
                'url' => $previousBook['url'],
                'title' => "Previous Book",
                'subtitle' => $previousBook['title'],
            ];
        }
    }

    private function crossReferences($chapter_id, $verseFrom, $verseTo)
    {

        if (!$verseFrom) {
            return false;
        }

        global $wpdb;

        $query = "SELECT verse_id, verse FROM wp_dev_verse WHERE chapter_id LIKE  %d AND verse LIKE  %d ";
        $verse_query = $verseFrom;

        if ($verseTo) {
            $verse_query = "{$verse_query}-{$verseFrom}";
        }

        $verses = $wpdb->get_results($wpdb->prepare(
            $query,
            $chapter_id,
            $verse_query
        ));

        $verse_ids = array_map(function ($verse) {
            return $verse->verse_id;
        }, $verses);

        if (empty($verse_ids)) {
            return false;
        }

        $placeholders = implode(',', array_fill(0, count($verse_ids), '%d'));

        $query = "
            SELECT verse_id_1, verse_id_2
            FROM wp_dev_verse_relationship
            WHERE verse_id_1 IN ($placeholders)
            OR verse_id_2 IN ($placeholders)
        ";

        $related_verse_ids = $wpdb->get_results($wpdb->prepare(
            $query,
            array_merge($verse_ids, $verse_ids)
        ));

        $reference_verse_ids = array_map(function ($ref) use ($verse_ids) {

            if (in_array($ref->verse_id_1, $verse_ids)) {
                return $ref->verse_id_2;
            }

            return $ref->verse_id_1;

        }, $related_verse_ids);

        $placeholders = implode(',', array_fill(0, count($reference_verse_ids), '%d'));

        $query = "
            SELECT verse_id, book, chapter, verse, chapter_id
            FROM wp_dev_verse
            WHERE verse_id IN ($placeholders)
            ";

        $references = $wpdb->get_results($wpdb->prepare(
            $query,
            $reference_verse_ids
        ));

        $cross_references = [];

        foreach ($verses as $verse) {

            $crosses = [];

            foreach ($related_verse_ids as $relation) {
                if ($relation->verse_id_1 == $verse->verse_id) {
                    $crosses[] = $relation->verse_id_2;
                } else if ($relation->verse_id_2 == $verse->verse_id) {
                    $crosses[] = $relation->verse_id_1;
                }
            }

            $verse_references = array_filter($references, function ($ref) use ($crosses) {
                return in_array($ref->verse_id, $crosses);
            });

            $verse_references = array_map(function ($ref) {

                $ref_book = $ref->book;
                $ref_chapter = $ref->chapter;
                $ref_verse = $ref->verse;
                $ref_chapter_id = $ref->chapter_id;

                $verse_name = "{$ref_book} {$ref_chapter}:{$ref_verse}";

                $url = home_url('bible');
                $ref_book = sanitize_title($ref_book);

                $path = 'verses';

                if (strpos($ref_verse, '-') === false) {
                    $path = 'verse';
                }

                $url = "{$url}/{$ref_book}/chapter-{$ref_chapter}/{$path}-{$ref_verse}/";

                return [
                    'verse' => $verse_name,
                    'url' => $url,
                    'text' => get_verse_from_chapter($ref_chapter_id, $ref_verse),
                ];
            }, $verse_references);

            $item = [
                'references' => $verse_references,
            ];

            if (!$verseFrom) {
                $item['verse'] = $verse->verse;
            }

            $cross_references[] = $item;

            if (!$verseFrom) {
                usort($cross_references, function ($a, $b) {
                    return $a['verse'] <=> $b['verse'];
                });
            }
        }

        return $cross_references;

    }

    private function youtubeMedia($chapter, $title, $verseFrom)
    {
        // $media
        $args = [
            'post_type' => 'bible_verse',
            'posts_per_page' => -1,
        ];

        if ($verseFrom) {
            $args['title'] = $title;
        } else {
            $args['meta_query'] = [
                [
                    'key' => 'chapter',
                    'value' => $chapter,
                    'compare' => '=',
                ],
            ];
        }

        $query = new \WP_Query($args);

        $media = [];

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();

                $video_id = get_field('youtube_video_id');
                $url = get_field('verse_url');
                $thumbnail = get_the_post_thumbnail_url();

                if ($video_id) {
                    $media[] = [
                        'id' => $video_id,
                        'thumbnail' => $thumbnail,
                        'title' => get_the_title(),
                        'url' => $url,
                    ];
                }

                // if ($verseFrom) {
                //     $this->blocks = get_field('page_builder_blocks');
                // }
            }
        }

        wp_reset_postdata();

        return $media;

    }

    private function blocks($pageType, $title)
    {

        $blocks = [];

        if ($pageType == 'chapter') {
            $blocks = get_field('page_builder_blocks');
        }

        $extras = get_extra_data_blocks($title);

        if ($extras) {
            $blocks = array_merge($blocks, $extras);
        }

        if (!$blocks) {
            return false;
        }

        $blocks = array_filter($blocks, function ($block) {
            return !empty($block);
        });

        return $blocks;
    }

    private function verseShortDescription($chapter, $verseFrom, $verseTo)
    {
        if (!$verseFrom) {
            return false;
        }

        global $wpdb;

        $verse = $verseFrom;

        if ($verseTo) {
            $verse = "{$verseFrom}-{$verseTo}";
        }

        $query = "SELECT excerpt FROM wp_dev_verse WHERE chapter_id LIKE  %d AND verse LIKE  %d ";

        $result = $wpdb->get_var($wpdb->prepare(
            $query,
            $chapter,
            $verse
        ));

        return $result;
    }

    private function thumbnail($verseFrom, $title)
    {
        if ($verseFrom) {
            return false;
        }

        if (has_post_thumbnail()) {
            return get_the_post_thumbnail(null, 'thumbnail', ['class' => 'thumbnail rounded mt-2', 'alt' => $title]);
        }
    }

    private function getPageType($verseFrom, $verseTo)
    {
        if ($verseFrom) {
            return 'verse';
        }

        if ($verseTo) {
            return 'verses';
        }

        return 'chapter';
    }
}
