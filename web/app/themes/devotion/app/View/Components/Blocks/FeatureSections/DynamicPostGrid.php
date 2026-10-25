<?php

namespace App\View\Components\blocks\FeatureSections;

use Illuminate\View\Component;

class DynamicPostGrid extends Component
{

    public $id;
    public $block;
    public $uppertitle;
    public $title;
    public $content;
    public $buttons;
    public $blockContent;

    public function __construct(
        $id = false,
        $block = false
    ) {
        $this->id = $id;

        $this->uppertitle = $block['uppertitle'];
        $this->title = $block['title'];
        $this->content = $block['content'];
        $this->buttons = $block['buttons'];
        $items_name = $block['block_content'] . '_items';
        $this->blockContent = $this->getPosts($block['block_content'], $block['post_order'], $block[$items_name], $block);
    }

    public function render()
    {
        return view('components.blocks.feature-sections.dynamic-post-grid', [
            'id' => $this->id,
            'uppertitle' => $this->uppertitle,
            'title' => $this->title,
            'content' => $this->content,
            'buttons' => $this->buttons,
            'query' => $this->blockContent,
        ]
        );
    }

    private function getPosts($post_type, $selection, $items, $extras)
    {
        $args = array(
            'post_type' => $post_type,
            'posts_per_page' => 3,
        );

        if ($selection == 'latest') {
            $args['orderby'] = 'date';
            $args['order'] = 'DESC';
        } else if ($selection == 'random') {
            $args['orderby'] = 'rand';
        } else if ($selection == 'manual') {
            $args['post__in'] = $items;
            $args['orderby'] = 'post__in';
        } else if ($selection == 'taxonomy') {
            $taxonomy = $extras['taxonomy'];
            $args['tax_query'] = array(
                array(
                    'taxonomy' => $taxonomy,
                    'terms' => $extras[$taxonomy . '_terms'],
                    'field' => 'slug',
                ),
            );
        }

        $query = new \WP_Query($args);

        return $query;
    }
}
