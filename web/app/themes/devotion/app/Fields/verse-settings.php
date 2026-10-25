<?php
use StoutLogic\AcfBuilder\FieldsBuilder;

$builder = new FieldsBuilder('verse_settings', ['title' => 'Settings']);

$builder
    ->setLocation('post_type', '==', 'bible_verse');

$builder
    ->addTab('Settings')
    ->addText('youtube_video_id',
        [
            'label' => 'YouTube ID',
            'rows' => 4,
            'wrapper' => [
                'width' => '25',
            ],
        ]
    )
    ->addPostObject('chapter',
        [
            'label' => 'Chapter',
            'post_type' => ['bible_chapter'],
            'wrapper' => [
                'width' => '25',
            ],
        ]
    )
    ->addSelect('type',
        [
            'label' => 'Type',
            'choices' => [
                'video' => 'Video',
                'short' => 'Short',
            ],
            'default_value' => 'short',
            'wrapper' => [
                'width' => '25',
            ],
        ]
    )
    ->addText('verse_url',
        [
            'label' => 'Verse URL',
            'wrapper' => [
                'width' => '25',
            ],
        ]
    )
    ->addTab('Image')
    ->addImage('og_image',
        [
            'label' => 'OG Image',
            'return_format' => 'id',
            'preview_size' => 'thumbnail',
            'library' => 'all',
        ]
    );

return $builder;
