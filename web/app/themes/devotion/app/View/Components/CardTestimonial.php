<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CardTestimonial extends Component
{

    public $id;
    public $testimonial;
    public $rating;
    public $authorDescription;
    public $logo;
    public $author;
    public $thumbnail;

    public function __construct($id = false)
    {
        $this->testimonial = get_field('testimonial', $id);
        $this->rating = intval(trim(get_field('rating', $id), '"'));
        $this->authorDescription = get_field('description', $id);
        $this->logo = get_field('logo', $id);
        $this->author = get_the_title($id);
        $this->thumbnail = get_post_thumbnail_id($id);
    }

    public function render()
    {
        return view('components.card-testimonial');
    }
}
