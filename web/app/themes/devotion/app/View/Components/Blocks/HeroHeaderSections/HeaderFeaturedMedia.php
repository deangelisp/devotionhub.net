<?php

namespace App\View\Components\blocks\HeroHeaderSections;

use Illuminate\View\Component;

class HeaderFeaturedMedia extends Component
{

    public $id;
    public $block;

    public function __construct(
        $id = false,
        $block = false,
    ) {
        $this->id = $id;
        $this->block = $block;

        $this->uppertitle = $block['uppertitle'];
        $this->title = $block['title'];
        $this->content = $block['content'];
        $this->buttons = $block['buttons'];
        $this->image = $block['image'];
        $this->aspect_ratio = $block['aspect_ratio'];
    }

    public function render()
    {
        return view('components.blocks.hero-header-sections.header-featured-media', [
            'id' => $this->id,
            'uppertitle' => $this->uppertitle,
            'title' => $this->title,
            'content' => $this->content,
            'buttons' => $this->buttons,
            'image' => $this->image,
            'aspect_ratio' => $this->aspect_ratio,
        ]);
    }
}
