<?php

use App\Fields\TemplatedFields\FieldsMessages;
use StoutLogic\AcfBuilder\FieldsBuilder;

$fieldsMessages = new FieldsMessages();

$builder = new FieldsBuilder('call_to_action_settings', ['title' => 'Settings']);

$builder
    ->setLocation('post_type', '==', 'call_to_action');

$builder
    ->addText('label',
        [
            'label' => 'Label',
            'wrapper' => [
                'width' => '25',
                'class' => 'field-horizontal',
            ],
        ]
    )
    ->addSelect('background_color',
        [
            'label' => 'Background Color',
            'choices' => [
                'primary' => 'Primary',
                'secondary' => 'Secondary',
                'tertiary' => 'Tertiary',
            ],
            'default_value' => 'secondary',
            'wrapper' => [
                'width' => '25',
                'class' => 'field-horizontal',
            ],
        ]
    )
    ->addMessage('call_to_action_settings_shortcode', 'message',
        [
            'label' => 'Shortcode',
            'message' => '',
            'new_lines' => 'wpautop',
            'esc_html' => 0,
            'wrapper' => [
                'width' => '25',
            ],
        ]
    )
    ->addWysiwyg('content', [
        'label' => 'Content',
        'media_upload' => 0,
        'toolbar' => 'full',
        'wrapper' => [
            'width' => '80',
        ],
    ])
    ->addImage('image',
        [
            'label' => 'Image',
            'return_format' => 'id',
            'preview_size' => 'thumbnail',

            'mime_types' => 'jpg, jpeg, png, webp',
            'instructions' => $fieldsMessages->imageInstructions('JPG, PNG or WEBP', '500KB', '300x300'),
            'wrapper' => [
                'width' => '20',
            ],
        ]
    );

return $builder;
