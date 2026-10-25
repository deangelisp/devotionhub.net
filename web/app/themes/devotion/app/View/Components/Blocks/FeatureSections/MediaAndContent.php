<?php

namespace App\View\Components\blocks\FeatureSections;

use Illuminate\View\Component;

class MediaAndContent extends Component
{
    public $id;
    public $block;
    public $title;
    public $content;
    public $buttons;
    public $image;
    public $aspect_ratio;
    public $imagePositioning;
    public $uppertitle;
    public $listItems;
    public $titleSize;
    public $listItemType;

    public function __construct(
        $id = false,
        $block = false
    ) {
        $this->id = $id;

        $this->uppertitle = $block['uppertitle'];
        $this->title = $block['title'];
        $this->content = $block['content'];
        $this->buttons = $block['buttons'];
        $this->image = $block['image'];
        $this->aspect_ratio = $block['aspect_ratio'];
        $this->imagePositioning = $block['image_positioning'];
        $this->listItems = $block['list_items'];
        // $this->titleSize = $block['list_items_title_size'];
        $this->titleSize = 'regular';
        $this->listItemType = $block['list_type'];
    }

    public function render()
    {
        return view('components.blocks.feature-sections.media-and-content', [
            'id' => $this->id,
            'uppertitle' => $this->uppertitle,
            'title' => $this->title,
            'content' => $this->content,
            'buttons' => $this->buttons,
            'image' => $this->image,
            'aspect_ratio' => $this->aspect_ratio,
            'imagePositioning' => $this->imagePositioning,
            'listItems' => $this->listItems,
            'titleSize' => $this->titleSize,
            'listItemType' => $this->listItemType,
        ]);
    }
}
