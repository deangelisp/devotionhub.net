<?php

namespace App\View\Components\blocks\FeatureSections;

use Illuminate\View\Component;

class ContentTabber extends Component
{
    public $id;
    public $uppertitle;
    public $title;
    public $content;
    public $buttons;
    public $tabs;
    public $tabLayout;

    public function __construct(
        $id = false,
        $block = false
    ) {
        $this->id = $id;

        $this->uppertitle = $block['uppertitle'];
        $this->title = $block['title'];
        $this->content = $block['content'];
        $this->buttons = $block['buttons'];
        $this->tabs = $block['tabs'];
        $this->tabLayout = $block['tab_layout'];
    }

    public function render()
    {
        return view('components.blocks.feature-sections.content-tabber', [
            'id' => $this->id,
            'uppertitle' => $this->uppertitle,
            'title' => $this->title,
            'content' => $this->content,
            'buttons' => $this->buttons,
            'tabs' => $this->tabs,
            'tabLayout' => $this->tabLayout,
        ]);
    }
}
