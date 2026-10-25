<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Breadcrumb extends Component
{

    public $breadcrumb;
    public $className;

    public function __construct($className = 'container mb-4 pt-4')
    {
        $this->className = $className;
        $this->breadcrumb = $this->breadcrumb();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.breadcrumb');
    }

    private function breadcrumb()
    {
        $breadcrumb = [];

        if (is_single()) {
            $post_type = get_post_type();

            if ($post_type == 'product') {
                $shop_id = get_option('woocommerce_shop_page_id');
                $breadcrumb[] = [
                    'title' => get_the_title($shop_id),
                    'url' => get_permalink($shop_id),
                ];

                $breadcrumb = $this->getBreadCrumbTerms('product_cat', $breadcrumb);

            } else {

                $breadcrumb = [

                    [
                        'title' => 'Home',
                        'url' => get_permalink(get_option('page_on_front')),
                    ],
                ];

                $archive = get_post_type_archive($post_type);

                if ($archive) {
                    $breadcrumb[] = [
                        'title' => $archive['title'],
                        'url' => $archive['link'],
                    ];
                }

                if ($post_type == 'post') {
                    array_shift($breadcrumb);

                    $breadcrumb = $this->getBreadCrumbTerms('category', $breadcrumb);
                }
            }

            $breadcrumb[] = [
                'title' => get_the_title(),
                'url' => get_the_permalink(),
            ];
        } else if (is_archive()) {
            $breadcrumb = [

                [
                    'title' => 'Home',
                    'url' => get_permalink(get_option('page_on_front')),
                ], [
                    'title' => get_the_title(get_true_post_id()),
                    'url' => '',
                ],
            ];
        }

        return $breadcrumb;
    }

    private function getBreadCrumbTerms($term, $breadcrumb)
    {

        $terms = get_the_terms(get_the_ID(), $term);

        if ($terms) {
            $terms = $this->organizeTerms($terms);

            foreach ($terms as $term) {
                $breadcrumb[] = [
                    'title' => $term->name,
                    'url' => get_term_link($term),
                ];
            }
        }

        return $breadcrumb;
    }

    private function organizeTerms($terms)
    {
        $chains = [];
        foreach ($terms as $term) {
            $currentChain = [$term];
            $parentTerm = $this->findParentTerm($terms, $term);
            while ($parentTerm !== null) {
                array_unshift($currentChain, $parentTerm); // Add the parent term at the beginning of the chain
                $parentTerm = $this->findParentTerm($terms, $parentTerm); // Find the next parent term
            }
            $chains[] = $currentChain; // Add the current chain to the list of chains
        }

        // Find the longest chain
        usort($chains, function ($a, $b) {
            return count($b) - count($a);
        });

        return $chains[0];
    }

    private function findParentTerm($terms, $term)
    {
        foreach ($terms as $currentTerm) {
            if ($currentTerm->term_id == $term->parent) {
                return $currentTerm;
            }
        }
        return null; // Return null if no parent term is found
    }
}
