<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Link extends Component
{

    public $url;
    public $title;
    public $target;
    public $className;

    public function __construct($data = null, $className = null)
    {
        if (isset($data['url'])) {
            $this->url = $data['url'] ?? null;
            $this->title = $data['title'] ?? null;
            $this->target = $data['target'];
            $this->className = $className;
        }
    }

    public function render()
    {
        return view('components.link');
    }
}
