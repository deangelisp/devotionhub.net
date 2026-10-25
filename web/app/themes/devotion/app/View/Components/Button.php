<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{

    public $url;
    public $title;
    public $target;
    public $className;
    public $style;

    public function __construct($link = null, $className = null, $style = null)
    {
        if (isset($link['url'])) {
            $this->url = $link['url'] ?? null;
            $this->title = $link['title'] ?? null;
            $this->target = $link['target'];
            $this->className = $className;

            if ($style == 'link') {
                $this->style = "link--low-contrast";
            } else {
                $this->style = "btn btn--{$style}";

            }
        }
    }

    public function render()
    {
        return view('components.button');
    }
}
