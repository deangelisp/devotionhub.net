<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$builder = new FieldsBuilder('extras');

$builder
    ->setLocation('taxonomy', '==', 'book')

    ->addText('bolls_book_id', [
        'label' => 'Book ID (Bolls API)',
    ])

    ->addText('testament', [
        'label' => 'Testament',
        'readonly' => 1,
    ])
    ->addText('total_chapters', [
        'label' => 'Chapters',
        'readonly' => 1,
    ])
    ->addText('book_order', [
        'label' => 'Order',
        'readonly' => 1,
    ])
    ->addText('subtitle', [
        'label' => 'Subtitle',
        'readonly' => 1,
    ])
    ->addImage('cover', [
        'label' => 'Cover',
        'preview_size' => 'thumbnail',
        'return_format' => 'id',
    ]);

$builder
    ->addRepeater('faq_list', [
        'label' => 'FAQ List',
        'layout' => 'block',
        'button_label' => 'Add FAQ',
        'collapsed' => 'heading',
    ])
    ->addText('heading', [
        'label' => 'Question',
        'required' => 1,
    ])
    ->addWysiwyg('body', [
        'label' => 'Answer',
        'required' => 1,
    ])
    ->endRepeater();

return $builder;
