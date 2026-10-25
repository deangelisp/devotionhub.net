<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Jobs extends Composer
{
    protected static $views = [
        'single-jobs',
    ];

    public function with()
    {
        return [
            'title' => $this->title(),
            'postedOn' => $this->postedOn(),
            'description' => $this->description(),
            'location' => $this->location(),
            'jobType' => $this->jobType(),
            'duration' => $this->duration(),
            'approximatePay' => $this->approximatePay(),
            'forminatorFormId' => $this->forminatorFormId(),
            'applicationDeadline' => $this->applicationDeadline(),
            'contactInfo' => $this->contactInfo(),
            'benefits' => $this->benefits(),
            'relatedJobs' => $this->relatedJobs(),
            'latestJobs' => $this->latestJobs(),
        ];
    }

    private function title()
    {
        return get_the_title();
    }

    private function postedOn()
    {

        return get_the_date();
    }

    private function description()
    {
        return get_field('description');
    }

    private function location()
    {
        return get_field('location');
    }

    private function jobType()
    {
        $termSlug = get_field('jobs_type');

        if ($termSlug) {
            $term = get_term_by('slug', $termSlug, 'jobs_type');
            // return [
            //     'name' => $term->name,
            //     'slug' => $term->slug,
            //     'link' => get_term_link($term),
            // ];
            if (isset($term->name)) {
                return $term->name;
            }
        }
        return false;
    }

    private function duration()
    {
        return get_field('duration');
    }

    private function approximatePay()
    {
        return get_field('approximate_pay');
    }

    private function forminatorFormId()
    {
        return get_field('forminator_form');
    }

    private function applicationDeadline()
    {
        $_format = get_option('date_format');
        return get_field('application_deadline');
    }

    private function contactInfo()
    {
        $name = get_field('contact_name');
        $email = get_field('contact_email');
        $phone = get_field('contact_phone');

        if ($name) {
            return [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
            ];
        }

        return false;
    }

    private function benefits()
    {
        return convertRepeaterToArray(get_field('benefits'), 'benefit');
    }

    private function relatedJobs()
    {
        $termID = get_field('jobs_type');

        $args = [
            'post_type' => 'jobs',
            'posts_per_page' => 4,
            'post__not_in' => [get_the_ID()],
            'meta_query' => [
                [
                    'key' => 'jobs_type',
                    'value' => $termID,
                    'compare' => '=',
                ],
            ],
        ];

        $query = new \WP_Query($args);

        $relatedJobs = [];
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $relatedJobs[] = get_the_ID();
            }
        }
        wp_reset_postdata();

        return $relatedJobs;
    }

    private function latestJobs()
    {
        $args = [
            'post_type' => 'jobs',
            'posts_per_page' => 4,
            'post__not_in' => [get_the_ID()],
        ];

        $query = new \WP_Query($args);

        $latestJobs = [];
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $latestJobs[] = get_the_ID();
            }
        }
        wp_reset_postdata();

        return $latestJobs;
    }
}
