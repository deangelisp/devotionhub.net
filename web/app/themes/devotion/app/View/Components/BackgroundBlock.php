<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BackgroundBlock extends Component
{

    public $type;
    public $background;
    public $image;
    public $parallax;
    public $video;

    public function __construct(
        $block = null,
    ) {

        $this->type = $block['background_element'];
        $this->background = false;
        $this->parallax = false;

        if ($this->type == 'image') {
            $this->parallax = $block['parallax'];

            if (wp_is_mobile() && $block['different_image_mobile']) {
                $this->background = wp_get_attachment_image_src($block['mobile_image'], 'massive')[0];
            } else {
                $this->background = wp_get_attachment_image_src($block['image'], 'massive')[0];
            }
        }

        if ($this->type == 'video') {
            $this->background = wp_get_attachment_url($block['video']);
        }

        if ($this->type == 'color') {
            $this->background = match ($block['background_color']) {
                'primary' => 'bg-primary',
                'secondary' => 'bg-secondary',
                default => 'bg-light-tone',
            };
        }
    }

    public function render()
    {
        return view('components.background-block');
    }
}
