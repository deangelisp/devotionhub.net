<?php

namespace App\View\Components\blocks\StatsSections;

use Illuminate\View\Component;

class StatsDisplay extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $id = false,
        $block = false
    ) {
        $this->id = $id;
        $this->uppertitle = $block['uppertitle'];
        $this->title = $block['title'];
        $this->content = $block['content'];
        $this->buttons = $block['buttons'];
        $this->stats = $block['stats'];
        $this->gridClassName = $this->getGridClassByCount(count($this->stats));
        $this->block = $block;
        $this->hasBackground = $block['background_element'] != 'none' ? true : false;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.blocks.stats-sections.stats-display', [
            'id' => $this->id,
            'uppertitle' => $this->uppertitle,
            'title' => $this->title,
            'content' => $this->content,
            'buttons' => $this->buttons,
            'stats' => $this->stats,
            'gridClassName' => $this->gridClassName,
            'block' => $this->block,
            'hasBackground' => $this->hasBackground,
        ]);
    }

    private function getGridClassByCount($count)
    {
        $gridClassName = '';
        switch ($count) {
            case 4:
                $gridClassName = 'grid-cols-4';
                break;
            case 5:
                $gridClassName = 'grid-cols-5';
                break;
            default:
                $gridClassName = 'grid-cols-3';
                break;
        }
        return $gridClassName = 'sm:' . $gridClassName;
    }
}
