<?php

namespace App\View\Components\blocks\FeatureSections;

use Illuminate\View\Component;

class GalleryPostRow extends Component
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
        $items_name = $block['block_content'] . '_items';
        $this->blockContent = $this->getPosts($block['block_content'], $block['post_order'], $block[$items_name], $block);
    }

    public function render()
    {
        return view('components.blocks.feature-sections.gallery-post-row', [
            'id' => $this->id,
            'uppertitle' => $this->uppertitle,
            'title' => $this->title,
            'content' => $this->content,
            'buttons' => $this->buttons,
            'gallery' => $this->blockContent,
        ]
        );
    }

    private function getPosts($post_type, $selection, $items, $extras)
    {

        $rows = 2;

        $args = array(
            'post_type' => $post_type,
            'posts_per_page' => ($rows * 5),
            'meta_query' => array(
                array(
                    'key' => '_thumbnail_id',
                    'compare' => 'EXISTS',
                ),
            ),
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

        $gallery_posts = array();

        if ($query->have_posts()) {
            $posts = [];
            while ($query->have_posts()) {
                $query->the_post();
                $posts[] = [
                    'title' => get_the_title(),
                    'image' => get_post_thumbnail_id(),
                    'link' => get_the_permalink(),
                ];
            }

            if (count($posts) == 1) {
                $posts = array_merge($posts, $posts);
            }

            // divide posts into rows
            $row1 = [];
            $row2 = [];

            foreach ($posts as $key => $post) {
                if ($key % 2 == 0) {
                    $row1[] = $post;
                } else {
                    $row2[] = $post;
                }
            }

            $post_rows = [$row1, $row2];

            // each row needs a min of 5 posts
            foreach ($post_rows as $key => $row) {
                while (count($post_rows[$key]) < 5) {
                    $post_rows[$key] = array_merge($post_rows[$key], $row);
                    $post_rows[$key] = array_slice($post_rows[$key], 0, 5);
                }
            }

            $gallery_posts = $post_rows;
        }

        return $gallery_posts;
    }
}
