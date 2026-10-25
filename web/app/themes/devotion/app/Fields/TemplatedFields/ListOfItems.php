<?php

namespace App\Fields\TemplatedFields;

class ListOfItems
{
    public function build($builder)
    {
        return $builder
            ->addTab('list_of_items',
                [
                    'label' => 'List of Items',
                ]
            )
            // option to be grid or list
            ->addSelect('list_type',
                [
                    'label' => 'List Type',
                    'choices' => [
                        'list' => 'List',
                        'grid' => 'Grid',
                    ],
                    'default_value' => 'grid',
                    'wrapper' => [
                        'width' => '25',
                        'class' => 'field-horizontal',
                    ],
                ]
            )
            // ->addButtonGroup('list_items_title_size', [
            //     'label' => 'Title Size',
            //     'choices' => [
            //         'regular' => 'Regular',
            //         'large' => 'Large',
            //     ],
            //     'default_value' => 'regular',
            //     'wrapper' => [
            //         'width' => '25',
            //         'class' => 'field-horizontal',
            //     ],
            // ])
            ->addRepeater('list_items', [
                'label' => 'List Items',
                'layout' => 'block',
                'button_label' => 'Add List Item',
            ])
            ->addTextarea('title', [
                'label' => 'Title',
                'rows' => 2,
                'new_lines' => 'br',
                'wrapper' => [
                    'width' => '25',
                ],
            ])
            ->addTextarea('content', [
                'label' => 'Content',
                'rows' => 4,
                'new_lines' => 'br',
                'wrapper' => [
                    'width' => '25',
                ],
            ])
            ->addImage('image', [
                'label' => 'Icon',
                'return_format' => 'id',
                'preview_size' => 'thumbnail',
                'wrapper' => [
                    'width' => '25',
                ],
            ])
            ->addLink('link', [
                'label' => 'Link',
                'wrapper' => [
                    'width' => '25',
                ],
            ])

            ->endRepeater();
    }
}
