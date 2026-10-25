<?php

use App\Fields\Blocks\BaseBlock;
use App\Fields\TemplatedFields\ButtonsRepeater;
use App\Fields\TemplatedFields\Content;
use App\Fields\TemplatedFields\FieldsMessages;
use App\Fields\TemplatedFields\Heading2;
use StoutLogic\AcfBuilder\FieldsBuilder;

class DynamicCustomGrid extends BaseBlock
{
    protected $name = 'dynamic_custom_grid';
    protected $category = 'feature_sections';

    public function defineFields()
    {
        $fieldsMessages = new FieldsMessages();
        $optionMediaMessage = "<p style='color: #2271b1; font-weight: bold; margin-bottom: 4px'>Icon</p>";
        $optionMediaMessage .= $fieldsMessages->imageInstructions('png or webp', '200KB', '200x200');
        $optionMediaMessage .= "<p style='color: #2271b1; font-weight: bold; margin-bottom: 4px'>Image</p>";
        $optionMediaMessage .= $fieldsMessages->imageInstructions('jpg, jpeg, png or webp', '600KB', '400px');

        $block = new FieldsBuilder($this->name, [
            'title' => 'Dynamic Custom Grid',
            'display' => 'block',
        ]);

        // DON'T REMOVE THIS
        $block->addText('block_category_name', [
            'default_value' => 'FeatureSections',
            'readonly' => 1,
            'wrapper' => ['class' => 'hidden'],
        ]);

        $block
            ->addTab('Content');

        (new Heading2())->build($block);
        (new Content())->build($block);
        (new ButtonsRepeater())->build($block);

        $block
            ->addTab('options', [
                'label' => 'List of items',
            ]);

        $block->addSelect('media_type', [
            'label' => 'Media Type',
            'choices' => [
                'icon' => 'Icon',
                'image' => 'Image',
            ],
            'default_value' => 'icon',
            'wrapper' => [
                'width' => '25',
                'class' => 'field-horizontal',
            ],
        ]);

        $block->addSelect('media_aspect_ratio',
            [
                'label' => 'Aspect Ratio',
                'choices' => [
                    'auto' => 'Auto',
                    'aspect-video' => 'Landscape (16x9)',
                    'aspect-portrait' => 'Portrait (9x16)',
                    'aspect-square' => 'Square',
                ],
                'default_value' => 'aspect-video',
                'wrapper' => [
                    'width' => '25',
                    'class' => 'field-horizontal',
                ],
            ]
        )
            ->conditional('media_type', '==', 'image');

        $block
            ->addRepeater('grid_content', [
                'label' => 'Grid Content',
                'layout' => 'block',
                'button_label' => 'Add Grid Item',
            ])
            ->addImage('image', [
                'label' => 'Media',
                'wrapper' => [
                    'width' => '20',
                ],
                'library' => 'all',
                'mime_types' => 'jpg, jpeg, png, webp',
                'instructions' => $optionMediaMessage,
                'return_format' => 'id',
                'preview_size' => 'thumbnail',
            ])

            ->addTextarea('title', [
                'label' => 'Title',
                'wrapper' => [
                    'width' => '20',
                ],
                'rows' => '2',
                'new_lines' => 'br',
            ])
            ->addTextarea('content', [
                'label' => 'Content',
                'rows' => '4',
                'wrapper' => [
                    'width' => '25',
                ],
                'new_lines' => 'br',
            ])
            ->addLink('link', [
                'label' => 'Link',
                'wrapper' => [
                    'width' => '20',
                ],
            ])
            ->addSelect('link_style', [
                'label' => 'Link Type',
                'choices' => [
                    'primary' => 'Primary',
                    'secondary' => 'Secondary',
                    'tertiary' => 'Tertiary',
                    'link' => 'Link',
                ],
                'wrapper' => [
                    'width' => '15',
                ],
            ]);

        return $block;
    }
}
