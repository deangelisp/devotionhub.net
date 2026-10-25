<?php

namespace App\View\Components\blocks\TeamSections;

use Illuminate\View\Component;

class People extends Component
{

    public function __construct(
        $id = false,
        $block = false
    ) {
        $this->id = $id;

        $this->uppertitle = $block['uppertitle'];
        $this->title = $block['title'];
        $this->content = $block['content'];
        $this->buttons = $block['buttons'];
        $this->query = $this->getPeople($block);
    }

    public function render()
    {
        return view('components.blocks.team-sections.people', [
            'id' => $this->id,
            'uppertitle' => $this->uppertitle,
            'title' => $this->title,
            'content' => $this->content,
            'buttons' => $this->buttons,
            'query' => $this->query,
        ]);
    }

    private function getPeople($block)
    {

        $order = $block['people_order'];

        $args = [
            'post_type' => 'people',
            'posts_per_page' => -1,
        ];

        if ($order == 'latest_people') {
            $args['orderby'] = 'date';
            $args['order'] = 'DESC';
        }

        if ($order == 'department_people') {
            $args['meta_query'] = [
                [
                    'key' => 'department',
                    'value' => $block['people_department'],
                    'compare' => '=',
                ],
            ];
        }

        if ($order == 'order_people') {
            $args['orderby'] = 'meta_value';
            $args['meta_key'] = 'order';
            $args['order'] = 'ASC';
        }

        if ($order == 'selected_people') {
            $args['post__in'] = $block['selected_people'];
            $args['orderby'] = 'post__in';
        }

        if ($order == 'random_people') {
            $args['orderby'] = 'rand';
        }

        $query = new \WP_Query($args);

        return $query;
    }
}
