<?php

use App\Fields\Blocks\BaseBlock;
use App\Fields\TemplatedFields\ButtonsRepeater;
use App\Fields\TemplatedFields\Content;
use App\Fields\TemplatedFields\FieldsMessages;
use App\Fields\TemplatedFields\Heading2;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ContentTabber extends BaseBlock
{
    protected $name = 'content_tabber';
    protected $category = 'feature_sections';

    public function defineFields()
    {
        $block = new FieldsBuilder($this->name, [
            'title' => 'Content Tabber',
            'display' => 'block',
        ]);

        // DON'T REMOVE THIS
        $block->addText('block_category_name', [
            'default_value' => 'FeatureSections',
            'readonly' => 1,
            'wrapper' => ['class' => 'hidden'],
        ]);

        $fieldsMessages = new FieldsMessages();
        $imagePath = get_template_directory_uri() . '/resources/images/admin/AcfAssets/';

        $block
            ->addTab('Content');

        (new Heading2())->build($block);
        (new Content())->build($block);
        (new ButtonsRepeater())->build($block);

        $block
            ->addTab('Tabs');

        $block->addRepeater('tabs', [
            'label' => 'Tabs',
            'layout' => 'block',
            'collapsed' => 'title',
        ])
            ->addImage('icon',
                [
                    'label' => 'Icon',
                    'library' => 'all',
                    'mime_types' => 'jpg, jpeg, png, webp',
                    'instructions' => $fieldsMessages->imageInstructions('jpg, png, webp', '100KB', '60x60'),
                    'wrapper' => [
                        'width' => '25',
                    ],
                    'return_format' => 'id',
                ]
            )
            ->addText('title', [
                'label' => 'Title',
                'wrapper' => ['width' => '25'],
            ])
            ->addTextarea('short_tab_description', [
                'label' => 'Short Tab Description',
                'rows' => 2,
                'new_lines' => 'br',
                'wrapper' => ['width' => '25'],
            ])

            ->addButtonGroup('content_type',
                [
                    'label' => 'Content Type',
                    'choices' => [
                        'image' => 'Image',
                        'video' => 'Video',
                        'text' => 'Text',
                    ],
                    'default_value' => 'text',
                    'wrapper' => [
                        'width' => '25',
                    ],
                ]
            )
            ->addWysiwyg('content_text', [
                'label' => 'Content Text',
                'wrapper' => ['width' => '100'],
                'conditional_logic' => [
                    [
                        [
                            'field' => 'content_type',
                            'operator' => '==',
                            'value' => 'text',
                        ],
                    ],
                ],
            ])

            ->addImage('content_image',
                [
                    'label' => 'Content Image',
                    'library' => 'all',
                    'mime_types' => 'jpg, jpeg, png, webp',
                    'instructions' => $fieldsMessages->imageInstructions('jpg, png, webp', '100KB', '1440x900'),
                    'wrapper' => [
                        'width' => '30',
                    ],
                    'return_format' => 'id',
                    'required' => 1,
                    'conditional_logic' => [
                        [
                            [
                                'field' => 'content_type',
                                'operator' => '==',
                                'value' => 'image',
                            ],
                        ],
                    ],
                ]
            )
            ->addImage('content_image_mobile',
                [
                    'label' => 'Content Image Mobile',
                    'library' => 'all',
                    'mime_types' => 'jpg, jpeg, png, webp',
                    'instructions' => $fieldsMessages->imageInstructions('jpg, png, webp', '100KB', '768x1024'),
                    'wrapper' => [
                        'width' => '30',
                    ],
                    'return_format' => 'id',
                    'conditional_logic' => [
                        [
                            [
                                'field' => 'content_type',
                                'operator' => '==',
                                'value' => 'image',
                            ],
                        ],
                    ],
                ]
            )

            ->addFile('content_video',
                [
                    'label' => 'Content Video',
                    'mime_types' => 'mp4,ogg,webm',
                    'instructions' => $fieldsMessages->videoInstructions('MP4, OGG or WEBM', '2MB'),
                    'wrapper' => [
                        'width' => '30',
                    ],
                    'return_format' => 'id',
                    'required' => 1,
                    'conditional_logic' => [
                        [
                            [
                                'field' => 'content_type',
                                'operator' => '==',
                                'value' => 'video',
                            ],
                        ],
                    ],
                ]
            )
            ->addButtonGroup('content_video_settings',
                [
                    'label' => 'Play Settings',
                    'choices' => [
                        'autoplay' => 'Autoplay',
                        'controls' => 'Controls',
                    ],
                    'default_value' => 'autoplay',
                    'wrapper' => [
                        'width' => '30',
                    ],
                    'conditional_logic' => [
                        [
                            [
                                'field' => 'content_type',
                                'operator' => '==',
                                'value' => 'video',
                            ],
                        ],
                    ],
                ]
            )
        ;

        $block
            ->addTab('Options');

        $block->addButtonGroup('tab_layout',
            [
                'label' => 'Tab Layout',
                'choices' => [
                    'extended' => 'Extended',
                    'centralized' => 'Centralized',
                ],
                'default_value' => 'extended',
                'wrapper' => [
                    'width' => '25',
                    'class' => 'field-horizontal',
                ],
            ]
        );

        $block
            ->addMessage('example_full_width_images',
                '<img src="' . $imagePath . '/content-tabber-extended.png" alt="Placeholder Image" class="acf-fc-layout-preview-thumb" style="width: 100%;">'
                , [
                    'label' => 'Extended Tabs Example',
                    'wrapper' => [
                        'width' => '25',
                    ],
                ])
            ->conditional('tab_layout', '==', 'extended');

        $block
            ->addMessage('example_narrow_width_images', '<img src="' . $imagePath . '/content-tabber-centralized.png" class="acf-fc-layout-preview-thumb" alt="Placeholder Image" style="width: 100%;">',
                [
                    'label' => 'Centralized Tabs Example',
                    'wrapper' => [
                        'width' => '25',
                    ],
                ])
            ->conditional('tab_layout', '==', 'centralized');

        return $block;
    }
}
