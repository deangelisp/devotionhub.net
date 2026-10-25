<?php

namespace App\View\Components\blocks\CtaSections;

use Illuminate\View\Component;

class BibleBooks extends Component
{
    public $id;
    public $block;
    public $title;
    public $books;

    public function __construct(
        $id = false,
        $block = false
    ) {
        $this->id = $id;
        $this->block = $block;

        $this->title = $block['title'];
        $this->content = $block['content'];
        $this->books = $this->getBooks();
    }

    public function render()
    {
        return view('components.blocks.cta-sections.bible-books', [
            'id' => $this->id,
            'block' => $this->block,
            'title' => $this->title,
            'content' => $this->content,
            'books' => $this->books,
        ]);
    }

    private function getBooks()
    {
        $books = get_books_schema();

        usort($books, function ($a, $b) {
            return $a['order'] <=> $b['order'];
        });

        return array_map(function ($book) {

            $image_id = get_field('cover', 'book_' . $book['id']);

            if (!$image_id) {
                $image_id = get_field('settings_general_default_thumbnail', 'option');
            }

            $image = wp_get_attachment_image_url($image_id, 'thumbnail');;

            $term = get_term($book['id'], 'book');

            return [
                'title' => $book['title'],
                'url' => "/bible/" . $book['slug'] . '/',
                'image' => $image,
                'description' => $term->description,
            ];
        }, $books);
    }
}
