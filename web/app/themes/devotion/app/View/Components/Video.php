<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Video extends Component
{

    public $video;
    public $videoType;
    public $settings;
    public $className;

    public function __construct($id = null, $settings = null, $className = null)
    {
        $video = wp_get_attachment_url($id);
        $videoType = wp_check_filetype($video);

        $this->video = $video;
        $this->videoType = $videoType['type'];
        $this->settings = [
            'autoplay' => $settings == 'autoplay',
            'controls' => $settings != 'autoplay',
            'loop' => $settings == 'autoplay',
            'muted' => $settings == 'autoplay',
            'playsinline' => true,
            'preload' => 'auto',
            'poster' => '',
        ];

        $this->settings = array_filter($this->settings);

        if (!$className) {
            $className = 'aspect-video w-full';
        }

        $this->className = $className;
    }

    public function render()
    {
        return view('components.video');
    }
}
