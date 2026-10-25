<?php

namespace App\View\Components\blocks\HeaderSections;

use Illuminate\View\Component;

class LadingPageHeader extends Component
{

    public $id;
    public $block;
    public $uppertitle;
    public $title;
    public $content;
    public $image;
    public $aspect_ratio;
    public $post_id;

    public function __construct(
        $id = false,
        $block = false,
    ) {
        $this->id = $id;
        $this->block = $block;

        $this->uppertitle = $block['uppertitle'];
        $this->title = $block['title'];
        $this->content = $block['content'];
        $this->image = $block['image'];
        $this->aspect_ratio = $block['aspect_ratio'];

        $this->post_id = get_the_ID();
    }

    public function render()
    {
        return view('components.blocks.header-sections.lading-page-header', [
            'id' => $this->id,
            'block' => $this->block,
            'uppertitle' => $this->uppertitle,
            'title' => $this->title,
            'content' => $this->content,
            'image' => $this->image,
            'aspect_ratio' => $this->aspect_ratio,
            'post_id' => $this->post_id,
        ]);
    }
}
