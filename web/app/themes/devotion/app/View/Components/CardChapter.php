<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CardChapter extends Component
{

    public $chapter;
    public $title;
    public $number;
    public $url;
    public $link;

    public function __construct($chapter, $url = null)
    {
        $number = $chapter['chapter'];
        $this->chapter = $chapter;
        $this->title = $chapter['title'];
        $this->number = $number;
        $this->link = $this->link($number, $url);
    }

    public function render()
    {
        return view('components.card-chapter');
    }

    private function link($number, $url)
    {

        return "{$url}chapter-{$number}/";
    }
}
