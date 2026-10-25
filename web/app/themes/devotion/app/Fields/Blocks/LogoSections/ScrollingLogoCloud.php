<?php

use App\Fields\Blocks\BaseBlock;
use App\Fields\TemplatedFields\ButtonsRepeater;
use App\Fields\TemplatedFields\Content;
use App\Fields\TemplatedFields\Heading2;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ScrollingLogoCloud extends BaseBlock
{
    protected $name = 'scrolling_logo_cloud';
    protected $category = 'logo_sections';

    public function defineFields()
    {
        $block = new FieldsBuilder($this->name, [
            'title' => 'Scrolling Logo Cloud',
            'display' => 'block',
        ]);

        // DON'T REMOVE THIS
        $block->addText('block_category_name', [
            'default_value' => 'LogoSections',
            'readonly' => 1,
            'wrapper' => ['class' => 'hidden'],
        ]);

        $block->addTab('Content');

        $block
            ->addMessage('info', 'info', [
                'label' => 'Add/Edit Logos',
                'message' => '<a href="/wp/wp-admin/edit.php?post_type=logo_cloud" target="_blank">Click here to add/edit logos</a>',
                'new_lines' => 'wpautop',
                'esc_html' => 0,
                'wrapper' => [
                    'class' => 'field-horizontal',
                ],
            ]);

        (new Heading2())->build($block);
        (new Content())->build($block);
        (new ButtonsRepeater())->build($block);

        $block->addTab('Options');

        $block
            ->addSelect('logo_cloud_order', [
                'label' => 'Order by',
                'choices' => [
                    'latest' => 'Latest',
                    'category' => 'Category',
                    'selected' => 'Selected',
                    'random' => 'Random',
                ],
                'default_value' => 'latest',
                'wrapper' => [
                    'width' => '25',
                    'class' => 'field-horizontal',
                ],
            ])

            ->addPostObject('logo_cloud_selected', [
                'label' => 'Select Logos',
                'post_type' => ['logo_cloud'],
                'multiple' => 1,
                'wrapper' => [
                    'width' => '75',
                    'class' => 'field-horizontal',
                ],
                'return_format' => 'id',
            ])
            ->conditional('logo_cloud_order', '==', 'selected')

            ->addSelect('logo_cloud_cat', [
                'label' => 'Category',
                'choices' => getTaxonomyTermsInChoicesFormat('logo_cloud_cat', 'Select a category'),
                'wrapper' => [
                    'width' => '25',
                    'class' => 'field-horizontal',
                ],
            ])
            ->conditional('logo_cloud_order', '==', 'category');

        return $block;
    }
}
