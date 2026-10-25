<?php

namespace App\View\Components\blocks\HeroHeaderSections;

use Illuminate\View\Component;

class HeaderSearch extends Component
{

    public $id;
    public $block;
    public $content;

    public function __construct(
        $id = false,
        $block = false,
    ) {
        $this->id = $id;
        $this->block = $block;

        $this->content = $block['content'];
    }

    public function render()
    {
        return view('components.blocks.hero-header-sections.header-search', [
            'id' => $this->id,
            'content' => $this->content,
        ]);
    }
}
