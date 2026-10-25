<?php

namespace App\Fields\TemplatedFields;

use App\Fields\TemplatedFields\FieldsMessages;

class Background
{
    public function build($builder)
    {

        $fieldsMessages = new FieldsMessages();

        return $builder
            ->addTab('Background')

            ->addButtonGroup('background_element',
                [
                    'label' => 'Element',
                    'choices' => [
                        'none' => '<span class="dashicons dashicons-no"></span>',
                        'image' => '<span class="dashicons dashicons-format-image"></span>',
                        'video' => '<span class="dashicons dashicons-format-video"></span>',
                        'color' => '<span class="dashicons dashicons-admin-appearance"></span>',
                    ],
                    'default_value' => 'none',
                    'wrapper' => [
                        'width' => '25',
                        'class' => 'field-horizontal',
                    ],
                ])

            ->addTrueFalse('parallax',
                [
                    'label' => 'Parallax',
                    'wrapper' => [
                        'width' => '25',
                        'class' => 'field-horizontal',
                    ],
                    'ui' => 1,
                ])
            ->conditional('background_element', '==', 'image')

            ->addTrueFalse('different_image_mobile',
                [
                    'label' => 'Different Image on Mobile',
                    'wrapper' => [
                        'width' => '25',
                        'class' => 'field-horizontal',
                    ],
                    'ui' => 1,
                ])
            ->conditional('background_element', '==', 'image')

            ->addMessage('video_message', '', [
                'wrapper' => [
                    'class' => 'acf-breakline',
                ],
            ])

            ->addImage('image', [
                'label' => 'Image',
                'return_format' => 'id',
                'preview_size' => 'medium',
                'library' => 'all',
                'mime_types' => 'jpg, jpeg, png, webp',
                'instructions' => $fieldsMessages->imageInstructions('JPG, PNG or WEBP', '2MB', '1920x1080'),
                'wrapper' => [
                    'width' => '25',
                ],
                'required' => true,
            ])
            ->conditional('background_element', '==', 'image')

            ->addImage('image_mobile', [
                'label' => 'Image Mobile',
                'return_format' => 'id',
                'preview_size' => 'medium',
                'library' => 'all',
                'mime_types' => 'jpg, jpeg, png, webp',
                'instructions' => $fieldsMessages->imageInstructions('JPG, PNG or WEBP', '1MB', '720x1280'),
                'wrapper' => [
                    'width' => '25',
                ],
                'required' => true,
            ])
            ->conditional('background_element', '==', 'image')
            ->conditional('different_image_mobile', '==', '1')

            // video
            ->addFile('video', [
                'label' => 'Video',
                'return_format' => 'id',
                'preview_size' => 'medium',
                'library' => 'all',
                'mime_types' => 'mp4, ogg, webm',
                'instructions' => $fieldsMessages->videoInstructions('MP4, OGG or WEBM', '10MB'),
                'wrapper' => [
                    'width' => '25',
                ],
                'required' => true,
            ])
            ->conditional('background_element', '==', 'video')

            // Color
            ->addSelect('background_color', [
                'label' => 'Color',
                'choices' => [
                    'primary' => 'Primary',
                    'secondary' => 'Secondary',
                    'tertiary' => 'Tertiary',
                ],
                'default_value' => 'primary',
                'wrapper' => [
                    'width' => '25',
                ],
            ])
            ->conditional('background_element', '==', 'color')

        ;
    }
}
