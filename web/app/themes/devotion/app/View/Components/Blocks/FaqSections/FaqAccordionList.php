<?php

namespace App\View\Components\blocks\FaqSections;

use Illuminate\View\Component;

class FaqAccordionList extends Component
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
        $this->faq_list = $block['faq_list'];
        $this->footer_content = $block['footer_content'];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.blocks.faq-sections.faq-accordion-list', [
            'id' => $this->id,
            'uppertitle' => $this->uppertitle,
            'title' => $this->title,
            'content' => $this->content,
            'faqList' => $this->faq_list,
            'footer' => $this->footer_content,
        ]);
    }
}
