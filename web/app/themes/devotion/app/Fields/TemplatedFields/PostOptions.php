<?php
namespace App\Fields\TemplatedFields;

class PostOptions
{
    public function build($builder)
    {
        $builder
            ->addTab('options');

        $builder
            ->addSelect('block_content',
                [
                    'label' => 'Block Content',
                    'choices' => [
                        'post' => 'Post',
                        'service' => 'Services',
                        'case_study' => 'Case Studies',
                    ],
                    'default_value' => 'post',
                    'wrapper' => [
                        'class' => 'field-horizontal',
                        'width' => '25',
                    ],

                ])

            ->addSelect('post_order', [
                'label' => 'Post Order',
                'choices' => [
                    'latest' => 'Lastest',
                    'manual' => 'Select',
                    'random' => 'Random',
                    'taxonomy' => 'Taxonomy',
                ],
                'default_value' => 'latest',
                'wrapper' => [
                    'class' => 'field-horizontal',
                    'width' => '25',
                ],
            ])

            ->addPostObject('post_items', [
                'label' => 'Post',
                'post_type' => ['post'],
                'multiple' => 1,
                'return_format' => 'id',
                'wrapper' => [
                    'class' => 'field-horizontal',
                    'width' => '25',
                ],
            ])
            ->conditional('post_order', '==', 'manual')->and('block_content', '==', 'post')

            ->addPostObject('service_items', [
                'label' => 'Services',
                'post_type' => ['service'],
                'multiple' => 0,
                'return_format' => 'id',
                'wrapper' => [
                    'class' => 'field-horizontal',
                    'width' => '25',
                ],
            ])
            ->conditional('post_order', '==', 'manual')->and('block_content', '==', 'service')

            ->addPostObject('case_study_items', [
                'label' => 'Case Studies',
                'post_type' => ['case_study'],
                'multiple' => 0,
                'return_format' => 'id',
                'wrapper' => [
                    'class' => 'field-horizontal',
                    'width' => '25',
                ],
            ])
            ->conditional('post_order', '==', 'manual')->and('block_content', '==', 'case_study');

        // available taxonomies
        $taxonomies = get_taxonomies([
            'public' => true], 'objects', 'and');

        unset($taxonomies['post_format']);

        $choices = [];

        foreach ($taxonomies as $taxonomy) {
            $choices[$taxonomy->name] = $taxonomy->label;
        }

        $builder
            ->addSelect('taxonomy', [
                'label' => 'Taxonomy',
                'choices' => $choices,
                'wrapper' => [
                    'class' => 'field-horizontal',
                    'width' => '25',
                ],
            ])
            ->conditional('post_order', '==', 'taxonomy');

        foreach ($taxonomies as $taxonomy) {

            $builder
                ->addSelect($taxonomy->name . '_terms', [
                    'label' => $taxonomy->label,
                    'choices' => getTaxonomyTermsInChoicesFormat($taxonomy->name),
                    'multiple' => 1,
                    'wrapper' => [
                        'class' => 'field-horizontal',
                        'width' => '25',
                    ],
                    'ui' => 1,
                ])
                ->conditional('post_order', '==', 'taxonomy')->and('taxonomy', '==', $taxonomy->name);
        }

        return $builder;

    }
}
