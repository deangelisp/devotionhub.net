<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BibleBooksCloud extends Component
{

    public $books;
    public $className;

    public function __construct($className = false)
    {
        $this->books = $this->getBooks();
        $this->className = $className;
    }

    public function render()
    {
        return view('components.bible-books-cloud');
    }

    private function getBooks()
    {
        $books = get_books_schema();

        usort($books, function ($a, $b) {
            return $a['order'] <=> $b['order'];
        });

        return array_map(function ($book) {
            return [
                'title' => $book['title'],
                'url' => "/bible/" . $book['slug'] . '/',
            ];
        }, $books);
    }
}
