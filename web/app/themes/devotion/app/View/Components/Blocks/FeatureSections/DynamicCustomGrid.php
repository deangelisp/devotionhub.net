<?php

namespace App\View\Components\blocks\FeatureSections;

use Illuminate\View\Component;

class DynamicCustomGrid extends Component
{

    public function __construct(
        $id = false,
        $block = false
    ) {
        $this->id = $id;

        $this->uppertitle = $block['uppertitle'];
        $this->title = $block['title'];
        $this->content = $block['content'];
        $this->buttons = $block['buttons'];
        $this->gridContent = $block['grid_content'];
        $this->mediaType = $block['media_type'];
        $this->aspectRatio = $block['media_aspect_ratio'];
    }

    public function render()
    {
        return view('components.blocks.feature-sections.dynamic-custom-grid', [
            'id' => $this->id,
            'uppertitle' => $this->uppertitle,
            'title' => $this->title,
            'content' => $this->content,
            'buttons' => $this->buttons,
            'gridContent' => $this->gridContent,
            'mediaType' => $this->mediaType,
            'aspectRatio' => $this->aspectRatio,
        ]
        );
    }
}
