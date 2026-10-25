<?php

// import base block class
use StoutLogic\AcfBuilder\FieldsBuilder;

//

$builder = new FieldsBuilder('page_builder', [
    'title' => 'Page Builder',
    'style' => 'seamless',
    'position' => 'acf_after_title',
    'hide_on_screen' => [
        'the_content',
    ],
]);

$builder
    ->setLocation('post_type', '==', 'page')
    ->and('page_template', '==', 'default')
    ->or('post_type', '==', 'service')
    ->or('post_type', '==', 'reusable_blocks')
    ->or('post_type', '==', 'case_study')
    ->or('post_type', '==', 'bible_chapter')
    ->or('post_type', '==', 'bible_verse')
    ->or('post_type', '==', 'course')
    ->or('post_type', '==', 'extra_data');

$builder
    ->addFlexibleContent('page_builder_blocks', [
        'label' => 'Page Builder (Blocks)',
        'button_label' => 'Add Block',
    ]);

foreach (getAllBlockInstances() as $blockInstance) {

    $blockFields = $blockInstance->defineFields();

    if (!$blockFields) {
        continue;
    }

    $category = $blockInstance->getCategory();
    $name = $blockInstance->getName();

    $permittedBlocks = get_option("options_permitted_page_builder_block_{$category}");

    if (is_array($permittedBlocks) && in_array($name, $permittedBlocks) && page_builder_condition_page_displays($blockInstance)) {
        $builder->getField('page_builder_blocks')->addLayout($blockFields);
    }
}

return $builder;

$builder->getField('page_builder_blocks')->addLayout($blockFields);
