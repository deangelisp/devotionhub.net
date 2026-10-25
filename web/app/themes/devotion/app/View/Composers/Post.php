<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Post extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'single',
    ];

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function override()
    {
        return [
            'postID' => get_the_ID(),
            'title' => $this->title(),
            'featured_image' => $this->featured_image(),
            'categories' => $this->categories(),
            'meta' => $this->meta(),
            'summary' => $this->summary(),
        ];
    }

    /**
     * Returns the post title.
     *
     * @return string
     */
    public function title()
    {
        return get_the_title();
    }

    public function featured_image()
    {

        $attachment_id = false;

        if (has_post_thumbnail()) {
            $attachment_id = get_post_thumbnail_id();
        } else {
            $attachment_id = get_field('settings_general_default_thumbnail', 'option');
        }

        return $attachment_id;
    }

    public function categories()
    {

        return get_the_category();
    }

    public function meta()
    {
        global $post;
        $author_id = $post->post_author;

        $date = get_the_date('d M Y');
        $author_display_name = get_the_author_meta('display_name', $author_id);
        $author_link = get_author_posts_url($author_id);
        $reading_time = get_field('reading_time');

        return [
            'author' => [
                'name' => $author_display_name,
                'link' => $author_link,
            ],
            'published_date' => $date,
            'reading_time' => $reading_time,
        ];

    }

    public function summary()
    {
        return get_field('summary');
    }

}
