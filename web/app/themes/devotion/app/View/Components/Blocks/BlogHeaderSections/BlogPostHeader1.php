<?php

namespace App\View\Components\blocks\BlogHeaderSections;

use App\View\Composers\App;
use Illuminate\View\Component;

class BlogPostHeader1 extends Component
{

    public $title;
    public $image;
    public $categories;
    public $reading;
    public $publishedon;
    public $postsLink;

    public function __construct(
        $title = false,
        $image = false,
        $categories = false,
        $reading = false,
        $publishedon = false,
    ) {

        $this->title = $title;
        $this->image = $image;
        $this->categories = $categories;
        $this->reading = $reading;
        $this->publishedon = $publishedon;
        $this->postsLink = App::postsLink();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.blocks.blog-header-sections.blog-post-header1');
    }
}
