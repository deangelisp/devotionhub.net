<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Book extends Composer
{
    protected static $views = [
        'archive-bible_chapter',
    ];

    public function with()
    {
        $bookID = get_query_var('book_id');

        $book = get_term($bookID, 'book');
        $books = get_books_schema();
        $schema = $books[$book->slug];

        return [
            'title' => $this->title($book->name),
            'excerpt' => $this->excerpt($book->description),
            'chapters' => $this->chapters($schema),
            'url' => $this->url($schema),
            'description' => $this->description($bookID),
            'thumbnail' => $this->thumbnail($bookID),
            'faq' => $this->faq($bookID, $book->name),
            'extraData' => $this->extraData($book->slug),
        ];
    }

    private function title($bookName)
    {
        return "Book of {$bookName}";
    }

    private function excerpt($excerpt)
    {
        return $excerpt;
    }

    private function chapters($schema)
    {
        return $schema['chapters'];

    }
    private function url($schema)
    {
        return "/bible/{$schema['slug']}/";

    }

    private function description($bookID)
    {
        return get_field('taxonomy_description', 'book_' . $bookID);
    }

    private function thumbnail($bookID)
    {
        $image_id = get_field('cover', 'book_' . $bookID);

        if ($image_id) {
            return wp_get_attachment_image($image_id, 'thumbnail', false, ['class' => 'rounded flex-shiring-0']);
        }

        return false;
    }

    private function faq($bookID, $bookName)
    {

        // 'id' => $this->id,
        // 'uppertitle' => $this->uppertitle,
        // 'title' => $this->title,
        // 'content' => $this->content,
        // 'faqList' => $this->faq_list,
        // 'footer' => $this->footer_content,

        $faq = get_field('faq_list', 'book_' . $bookID);

        if (!$faq) {
            return false;
        }

        return [
            'id' => 0,
            'uppertitle' => false,
            'title' => "F.A.Q. for the Book of {$bookName}",
            'content' => false,
            'faqList' => $faq,
            'footer' => false,
        ];
    }

    private function extraData($bookSlug)
    {
        return get_extra_data_blocks($bookSlug);
    }
}
