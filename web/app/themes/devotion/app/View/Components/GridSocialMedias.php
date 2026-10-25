<?php

namespace App\View\Components;

use Illuminate\View\Component;

class GridSocialMedias extends Component
{

    public $socials;
    public $className;
    public $iconSize;

    public function __construct(
        $socials = null,
        $className = 'flex items-center gap-4 mt-8',
        $iconSize = 'w-5 h-5'
    ) {
        $this->socials = convertSocialMediasToArray($socials);
        $this->className = $className;
        $this->iconSize = $iconSize;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.grid-social-medias');
    }
}
