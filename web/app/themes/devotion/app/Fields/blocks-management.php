<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$builder = new FieldsBuilder('blocks_management', ['title' => 'Blocks Management']);
$builder->setLocation('options_page', '==', 'acf-options-blocks-management');

// Header
$header = $builder->addTab('header',
    [
        'placement' => 'left',
    ]
);

$header->addSelect('settings_header_navbar', [
    'label' => 'Navbar',
    'choices' => [
        'navbar2' => 'Navbar 2',
    ],
    'default_value' => 'navbar2',
    'wrapper' => ['width' => '25'],
]);

// Footer
$footer = $builder->addTab('footer',
    [
        'placement' => 'left',
    ]
);

$footer->addSelect('settings_footer', [
    'label' => 'Footer',
    'choices' => [
        'Footer3' => 'Footer 3',
        'Footer7' => 'Footer 7',
    ],
    'default_value' => 'Footer3',
    'wrapper' => ['width' => '25'],
]);

// Page Builder
$pageBuilder = $builder->addTab('page_builder',
    [
        'placement' => 'left',
    ]
);

$checkboxes = getAllBlocksToCheckbox();

foreach ($checkboxes as $category => $blocks) {

    $categoryTitle = convertSnakeCaseToTitle($category);

    $pageBuilder->addCheckbox("permitted_page_builder_block_$category", [
        'label' => $categoryTitle,
        'choices' => $blocks,
        'toggle' => 1,
        'wrapper' => ['width' => '25'],
    ]);
}

return $builder;

function getAllBlocksToCheckbox()
{
    $blocks = getAllBlockInstances();

    $choices = [];
    foreach ($blocks as $block) {
        $category = $block->getCategory();
        $name = $block->getName();

        if (!isset($choices[$category])) {
            $choices[$category] = [];
        }

        $choices[$category][$name] = convertSnakeCaseToTitle($name);
    }
    return $choices;
}
