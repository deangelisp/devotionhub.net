<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CardPost extends Component
{

    public $title;
    public $thumbnail;
    public $excerpt;
    public $categories;
    public $link;

    public function __construct(
        $title = null,
        $excerpt = null,
        $link = null,
        $postid = null,
        $categories = null,
    ) {
        $this->title = $title;
        $this->thumbnail = getTheThumbnail($postid);
        $this->excerpt = trim_text_to_length($excerpt);
        $this->categories = $this->getPostTaxonomy();
        $this->link = $link;

    }

    public function render()
    {
        return view('components.card-post');
    }

    public function getPostTaxonomy()
    {

        $taxonomy = 'category';

        $post_type = get_post_type();

        if ($post_type == 'service') {
            $taxonomy = 'service_cat';
        } else if ($post_type == 'case_study') {
            $taxonomy = 'case_study_cat';
        }

        $terms = get_the_terms(get_the_ID(), $taxonomy);

        // $categories = [];

        // if ($terms) {
        //     foreach ($terms as $term) {
        //         $categories[] = $term->name;
        //     }
        // }

        return $terms;

    }
}
