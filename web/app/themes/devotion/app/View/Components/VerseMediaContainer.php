<?php

namespace App\View\Components;

use Illuminate\View\Component;

class VerseMediaContainer extends Component
{

    public $media;
    public $displaytitle;

    public function __construct($media = null, $displaytitle = false)
    {
        $this->media = $media;
        $this->displaytitle = $displaytitle;
    }

    public function render()
    {
        return view('components.verse-media-container');
    }
}
