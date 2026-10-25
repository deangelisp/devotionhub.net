<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Author extends Composer
{
    protected static $views = [
        'author',
    ];

    public function override()
    {
        return [
            'title' => $this->title(),
            'description' => $this->description(),
        ];
    }

    private function title()
    {
        return get_the_author_meta('display_name');
    }

    private function description()
    {
        return get_the_author_meta('description');
    }
}
