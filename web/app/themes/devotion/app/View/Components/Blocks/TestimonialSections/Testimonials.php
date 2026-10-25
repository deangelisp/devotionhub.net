<?php

namespace App\View\Components\blocks\TestimonialSections;

use Illuminate\View\Component;

class Testimonials extends Component
{
    public $id;
    public $block;
    public $uppertitle;
    public $title;
    public $content;
    public $buttons;

    public function __construct(
        $id = false,
        $block = false
    ) {
        $this->id = $id;

        $this->uppertitle = $block['uppertitle'];
        $this->title = $block['title'];
        $this->content = $block['content'];
        $this->buttons = $block['buttons'];
        $this->query = $this->getTestimonials($block);
    }

    public function render()
    {
        return view('components.blocks.testimonial-sections.testimonials', [
            'id' => $this->id,
            'uppertitle' => $this->uppertitle,
            'title' => $this->title,
            'content' => $this->content,
            'buttons' => $this->buttons,
            'query' => $this->query,
        ]);
    }

    private function getTestimonials($block)
    {

        $order = $block['testimonial_order'];

        $args = [
            'post_type' => 'testimonial',
            'posts_per_page' => -1,
        ];

        if ($order == 'latest_testimonial') {
            $args['orderby'] = 'date';
            $args['order'] = 'DESC';
        }

        if ($order == 'order_testimonial') {
            $args['orderby'] = 'meta_value';
            $args['meta_key'] = 'order';
            $args['order'] = 'ASC';
        }

        if ($order == 'selected_testimonial') {
            $args['post__in'] = $block['selected_testimonials'];
            $args['orderby'] = 'post__in';
        }

        if ($order == 'category_testimonial') {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'category',
                    'field' => 'term_id',
                    'terms' => $block['category'],
                ],
            ];
        }

        if ($order == 'tag_testimonial') {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'post_tag',
                    'field' => 'term_id',
                    'terms' => $block['tag'],
                ],
            ];
        }

        if ($order == 'random_testimonial') {
            $args['orderby'] = 'rand';
        }

        if ($order != 'selected_testimonial') {
            $args['posts_per_page'] = $block['number_of_testimonials'];
        }

        $query = new \WP_Query($args);

        return $query;
    }
}
