<?php

use App\Fields\Blocks\BaseBlock;
use App\Fields\TemplatedFields\ButtonsRepeater;
use App\Fields\TemplatedFields\Content;
use App\Fields\TemplatedFields\Heading2;
use StoutLogic\AcfBuilder\FieldsBuilder;

class People extends BaseBlock
{
    protected $name = 'people';
    protected $category = 'team_sections';

    public function defineFields()
    {
        $block = new FieldsBuilder($this->name, [
            'title' => 'People',
            'display' => 'block',
        ]);

        // DON'T REMOVE THIS
        $block->addText('block_category_name', [
            'default_value' => 'TeamSections',
            'readonly' => 1,
            'wrapper' => ['class' => 'hidden'],
        ]);

        $block
            ->addTab('content');

        (new Heading2())->build($block);
        (new Content())->build($block);
        (new ButtonsRepeater())->build($block);

        $block
            ->addTab('options');

        $block
            ->addSelect('people_order', [
                'label' => 'People by',
                'choices' => [
                    'order_people' => 'Order from settings',
                    'department_people' => 'Department',
                    'latest_people' => 'Latest people',
                    'selected_people' => 'Selected people',
                    'random_people' => 'Random people',
                ],
                'default_value' => 'order_people',
                'wrapper' => [
                    'width' => '25',
                    'class' => 'field-horizontal',
                ],
            ])

            ->addPostObject('selected_people', [
                'label' => 'Selected People',
                'post_type' => ['people'],
                'multiple' => 1,
                'wrapper' => [
                    'width' => '75',
                    'class' => 'field-horizontal',
                ],
                'return_format' => 'id',
            ])
            ->conditional('people_order', '==', 'selected_people')

            ->addSelect('people_department', [
                'label' => 'Department',
                'choices' => getTaxonomyTermsInChoicesFormat('department', 'Select a department'),
                'wrapper' => [
                    'width' => '25',
                    'class' => 'field-horizontal',
                ],
            ])
            ->conditional('people_order', '==', 'department_people');

        return $block;
    }
}
