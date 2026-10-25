<?php

namespace App\View\Components\blocks\FeatureSections;

use Illuminate\View\Component;

class CardGrid extends Component
{
    public $id;
    public $uppertitle;
    public $title;
    public $content;
    public $buttons;
    public $cards;
    public $numbered;
    public $tinted;
    public $gridClassName;

    public function __construct(
        $id = false,
        $block = false
    ) {
        $this->id = $id;

        $this->uppertitle = $block['uppertitle'] ?? '';
        $this->title = $block['title'] ?? '';
        $this->content = $block['content'] ?? '';
        $this->buttons = $block['buttons'] ?? false;
        $this->cards = $block['cards'] ?? false;
        $this->numbered = (bool) ($block['numbered'] ?? false);
        $this->tinted = (bool) ($block['tinted'] ?? false);

        $this->gridClassName = match ($block['columns'] ?? '3') {
            '2' => 'md:grid-cols-2',
            '4' => 'md:grid-cols-2 lg:grid-cols-4',
            default => 'md:grid-cols-2 lg:grid-cols-3',
        };
    }

    public function render()
    {
        return view('components.blocks.feature-sections.card-grid', [
            'id' => $this->id,
            'uppertitle' => $this->uppertitle,
            'title' => $this->title,
            'content' => $this->content,
            'buttons' => $this->buttons,
            'cards' => $this->cards,
            'numbered' => $this->numbered,
            'tinted' => $this->tinted,
            'gridClassName' => $this->gridClassName,
        ]);
    }
}
