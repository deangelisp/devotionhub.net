<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CardJob extends Component
{

    public $id;
    public $title;
    public $excerpt;
    public $link;
    public $location;
    public $jobtype;

    public function __construct(
        $id = null
    ) {
        $this->id = $id;
        $this->title = get_the_title($id);
        $this->excerpt = get_the_excerpt($id);
        $this->link = [
            'url' => get_the_permalink($id),
            'title' => 'Apply Now',
            'target' => '',
        ];
        $this->location = get_field('location', $id);
        $this->jobtype = get_field('jobs_type', $id);

        if ($this->jobtype) {
            $term = get_term_by('slug', $this->jobtype, 'jobs_type');

            if (isset($term->name)) {
                $this->jobtype = $term->name;
            }
        }
    }

    public function render()
    {
        return view('components.card-job');
    }
}
