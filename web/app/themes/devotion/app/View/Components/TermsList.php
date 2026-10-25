<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TermsList extends Component
{

    public $terms;

    public function __construct($terms = null)
    {

        $this->terms = $this->transformTerms($terms);

    }

    public function render()
    {
        return view('components.terms-list');
    }

    public function transformTerms($terms)
    {

        $categories = [];

        if (!empty($terms)) {

            foreach ($terms as $category) {
                $link = get_category_link($category->term_id);

                $categories[] = [
                    'name' => $category->name,
                    'link' => $link,
                ];
            }

        }

        return $categories;
    }
}
