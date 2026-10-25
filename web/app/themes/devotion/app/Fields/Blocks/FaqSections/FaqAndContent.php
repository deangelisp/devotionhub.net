<?php

use App\Fields\Blocks\BaseBlock;
use App\Fields\TemplatedFields\Content;
use App\Fields\TemplatedFields\FaqList;
use App\Fields\TemplatedFields\Heading2;
use StoutLogic\AcfBuilder\FieldsBuilder;

class FaqAndContent extends BaseBlock
{
    protected $name = 'faq_and_content';
    protected $category = 'faq_sections';

    public function defineFields()
    {
        $block = new FieldsBuilder($this->name, [
            'title' => 'FAQ and Content',
            'display' => 'block',
        ]);

        // DON'T REMOVE THIS
        $block->addText('block_category_name', [
            'default_value' => 'FaqSections',
            'readonly' => 1,
            'wrapper' => ['class' => 'hidden'],
        ]);

        $block
            ->addTab('Content');

        (new Heading2())->build($block);
        (new Content())->build($block);

        $block
            ->addTab('FAQ List');

        $block
            ->addButtonGroup('list_positioning',
                [
                    'label' => 'List Positioning',
                    'choices' => [
                        'list-left' => '<span class="dashicons dashicons-align-left"></span>',
                        'list-right' => '<span class="dashicons dashicons-align-right"></span>',
                    ],
                    'default_value' => 'list-right',
                    'wrapper' => [
                        'width' => '25',
                        'class' => 'field-horizontal',
                    ],
                ]
            );

        (new FaqList())->build($block);

        return $block;
    }
}
