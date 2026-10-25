<?php

namespace App\View\Components\blocks\HeaderSections;

use Illuminate\View\Component;

class FullScreenHeader extends Component
{

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

        $this->textColor = getTextColorFromBackgroundBlock($block);

    }

    public function render()
    {
        return view('components.blocks.header-sections.full-screen-header', [
            'id' => $this->id,
            'block' => $this->block,
            'uppertitle' => $this->uppertitle,
            'title' => $this->title,
            'content' => $this->content,
            'buttons' => $this->buttons,
            'textColor' => $this->textColor,
        ]);
    }
}
