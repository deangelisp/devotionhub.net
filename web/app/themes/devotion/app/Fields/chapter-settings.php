<?php
use StoutLogic\AcfBuilder\FieldsBuilder;

$builder = new FieldsBuilder('chapter_settings', ['title' => 'Settings']);

$builder
    ->setLocation('post_type', '==', 'bible_chapter');

$builder
    ->addTab('Settings')
    ->addText('title',
        [
            'label' => 'Title',
            'wrapper' => [
                'width' => '50',
                'class' => 'field-horizontal',
            ],
            'readonly' => 1,
        ]
    )
    ->addText('chapter',
        [
            'label' => 'Chapter',
            'wrapper' => [
                'width' => '25',
                'class' => 'field-horizontal',
            ],
            'readonly' => 1,
        ]
    )
    ->addText('total_verses',
        [
            'label' => 'Number of Verses',
            'wrapper' => [
                'width' => '25',
                'class' => 'field-horizontal',
            ],
            'readonly' => 1,
        ]
    )

    ->addTextarea('paragraph',
        [
            'label' => 'Paragraph',
            'rows' => 4,
            'wrapper' => [
                'width' => '33',
            ],
            'readonly' => 1,
        ]
    )
    ->addTextarea('notes',
        [
            'label' => 'Notes',
            'rows' => 4,
            'wrapper' => [
                'width' => '33',
            ],
            'readonly' => 1,
        ]
    )
    ->addTextarea('meta_description',
        [
            'label' => 'Meta Description',
            'rows' => 4,
            'wrapper' => [
                'width' => '33',
            ],
        ]
    )
    ->addTab('Chapter Verses')
    ->addRepeater('verses',
        [
            'label' => 'Verses',
            'layout' => 'block',
            'button_label' => 'Add Verse',
            'readonly' => 1,
        ]
    )
    ->addText('verse',
        [
            'label' => 'Verse',
            'wrapper' => [
                'width' => '10',
            ],
        ]
    )
    ->addTextarea('text',
        [
            'label' => 'Text',
            'rows' => 4,
            'wrapper' => [
                'width' => '80',
            ],
        ]
    )
    ->addTrueFalse('nobreak',
        [
            'label' => 'No Break',
            'wrapper' => [
                'width' => '10',
            ],
        ]
    );

return $builder;
