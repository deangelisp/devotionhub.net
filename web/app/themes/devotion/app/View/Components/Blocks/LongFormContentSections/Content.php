<?php

namespace App\View\Components\blocks\LongFormContentSections;

use Illuminate\View\Component;

class Content extends Component
{

    public $id;
    public $block;
    public $uppertitle;
    public $title;
    public $content;
    public $className;

    public function __construct($id = null, $block = null)
    {
        $this->id = $id;
        $this->block = $block;

        $this->uppertitle = $block['uppertitle'];
        $this->title = $block['title'];
        $this->content = $block['content'] ?? '';

        $this->className = '';

        if ($block['content_width'] == 'narrow') {
            $this->className = 'max-w-4xl';

            if ($block['full_width_images']) {
                $this->className = 'p-max-w-4xl';
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.blocks.long-form-content-sections.content', [
            'id' => $this->id,
            'uppertitle' => $this->uppertitle,
            'title' => $this->title,
            'content' => $this->content,
            'className' => $this->className,
        ]);
    }
}
