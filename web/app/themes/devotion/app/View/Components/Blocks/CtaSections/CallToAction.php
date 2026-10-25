<?php

namespace App\View\Components\blocks\CtaSections;

use Illuminate\View\Component;

class CallToAction extends Component
{
    public function __construct(
        $id = false,
        $block = false
    ) {
        $this->id = $id;
        $this->block = $block;

        $this->uppertitle = $block['uppertitle'];
        $this->title = $block['title'];
        $this->content = $block['content'];
        $this->buttons = $block['buttons'];
        $this->style = $block['style'];

        $this->textColor = getTextColorFromBackgroundBlock($block);
    }

    public function render()
    {
        return view('components.blocks.cta-sections.call-to-action', [
            'id' => $this->id,
            'block' => $this->block,
            'uppertitle' => $this->uppertitle,
            'title' => $this->title,
            'content' => $this->content,
            'buttons' => $this->buttons,
            'style' => $this->style,
            'textColor' => $this->textColor,
        ]);
    }
}
