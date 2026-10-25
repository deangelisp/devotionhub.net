<?php

namespace App\Fields\TemplatedFields;

use App\Fields\TemplatedFields\FieldsMessages;

class ImageTab
{
    public function build($builder, $positioning = false, $imageRequired = true, $aspectRatio = true)
    {

        $fieldsMessages = new FieldsMessages();

        $builder
            ->addTab('Image');

        if ($positioning) {
            $builder
                ->addButtonGroup('image_positioning',
                    [
                        'label' => 'Image Positioning',
                        'choices' => [
                            'image-left' => '<span class="dashicons dashicons-align-left"></span>',
                            'image-right' => '<span class="dashicons dashicons-align-right"></span>',
                        ],
                        'default_value' => 'image-left',
                        'wrapper' => [
                            'width' => '25',
                            'class' => 'field-horizontal',
                        ],
                    ]
                );
        }

        if ($aspectRatio) {
            $builder->addSelect('aspect_ratio',
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
            );
        }

        $builder
            ->addTrueFalse('different_image_mobile',
                [
                    'label' => 'Different Image on Mobile',
                    'wrapper' => [
                        'width' => '25',
                        'class' => 'field-horizontal',
                    ],
                    'ui' => 1,
                ]
            )
            ->addMessage('video_message', '', [
                'wrapper' => [
                    'class' => 'acf-breakline',
                ],
            ])
            ->addImage('image', [
                'label' => 'Image',
                'required' => $imageRequired,
                'return_format' => 'id',
                'preview_size' => 'medium',
                'library' => 'all',
                'mime_types' => 'jpg, jpeg, png, webp',
                'instructions' => $fieldsMessages->imageInstructions('JPG, PNG or WEBP', '1MB', '1080x1080'),
                'wrapper' => [
                    'width' => '25',
                ],
            ])
            ->addImage('image_mobile', [
                'label' => 'Image Mobile',
                'required' => 1,
                'return_format' => 'id',
                'preview_size' => 'medium',
                'library' => 'all',
                'mime_types' => 'jpg, jpeg, png, webp',
                'instructions' => $fieldsMessages->imageInstructions('JPG, PNG or WEBP', '1MB', '720x1280'),
                'conditional_logic' => [
                    [[
                        'field' => 'different_image_mobile',
                        'operator' => '==',
                        'value' => '1',
                    ]],
                ],
                'wrapper' => [
                    'width' => '25',
                ],
            ])
        ;

        return $builder;
    }
}
