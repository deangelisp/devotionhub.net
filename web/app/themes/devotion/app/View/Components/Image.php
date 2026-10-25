<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Image extends Component
{

    public $id;
    public $image;
    public $className;
    public $aspect;
    public $mobile;
    public $size;

    public function __construct(
        $id = false,
        $className = false,
        $aspect = false,
        $mobile = false,
        $size = 'container',
    ) {

        if ($aspect != 'auto') {
            $aspect = "{$aspect} object-cover";
        }

        if ($size == 'container' && wp_is_mobile()) {
            $size = 'medium';
        }

        $this->image = wp_get_attachment_image($id, $size, false, [
            'class' => "$className $aspect largest-contentful-paint",
            // 'loading' => 'lazy',
            'fetchpriority' => 'low',
        ]);
    }

    public function render()
    {
        return view('components.image');
    }
}
