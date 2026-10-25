<?php

namespace App\View\Components\blocks\HeaderSections;

use Illuminate\View\Component;

class CourseHero extends Component
{
    public $id;
    public $uppertitle;
    public $title;
    public $subtitle;
    public $content;
    public $primaryButton;
    public $secondaryButton;
    public $note;
    public $image;
    public $imagePhone;

    public function __construct(
        $id = false,
        $block = false,
    ) {
        $this->id = $id;

        $this->uppertitle = $block['uppertitle'] ?? '';
        $this->title = $block['title'] ?? '';
        $this->subtitle = $block['subtitle'] ?? '';
        $this->content = $block['content'] ?? '';
        $this->primaryButton = $block['primary_button'] ?? null;
        $this->secondaryButton = $block['secondary_button'] ?? null;
        $this->note = $block['note'] ?? '';
        $this->image = $block['image'] ?? false;
        $this->imagePhone = $block['image_phone'] ?? false;
    }

    public function render()
    {
        return view('components.blocks.header-sections.course-hero', [
            'id' => $this->id,
            'uppertitle' => $this->uppertitle,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'content' => $this->content,
            'primaryButton' => $this->primaryButton,
            'secondaryButton' => $this->secondaryButton,
            'note' => $this->note,
            'image' => $this->image,
            'imagePhone' => $this->imagePhone,
        ]);
    }
}
