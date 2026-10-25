<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RelatedPosts extends Component
{

    public $postid;
    public $posttype = 'post';
    public $taxonomies;
    public $query;
    public $title;

    public function __construct(
        $postid = null,
        $posttype = 'post',
        $taxonomies = null,
        $title = 'Related Posts',
    ) {

        if (is_null($postid)) {
            return;
        }

        $this->query = $this->getPosts($posttype,
            $postid,
            $taxonomies);

        $this->title = $title;

    }

    private function getPosts($post_type = 'post', $post_id, $taxonomies)
    {

        $args = array(
            'post_type' => $post_type,
            'posts_per_page' => 3,
            'post__not_in' => array($post_id),
        );

        if (!is_null($taxonomies)) {
            $args['tax_query'] = array(
                'relation' => 'OR',
            );

            foreach ($taxonomies as $taxonomy) {
                $args['tax_query'][] = array(
                    'taxonomy' => $taxonomy->taxonomy,
                    'field' => 'id',
                    'terms' => $taxonomy->term_id,
                );
            }
        }

        $query = new \WP_Query($args);

        return $query;

    }

    public function render()
    {
        return view('components.related-posts');
    }
}
