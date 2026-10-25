<?php

use App\Fields\Blocks\BaseBlock;
use App\Fields\TemplatedFields\Background;
use App\Fields\TemplatedFields\ButtonsRepeater;
use App\Fields\TemplatedFields\Content;
use App\Fields\TemplatedFields\Heading2;
use StoutLogic\AcfBuilder\FieldsBuilder;

class StatsDisplay extends BaseBlock
{
    protected $name = 'stats_display';
    protected $category = 'stats_sections';

    public function defineFields()
    {
        $block = new FieldsBuilder($this->name, [
            'title' => 'Stats Display',
            'display' => 'block',
        ]);

        // DON'T REMOVE THIS
        $block->addText('block_category_name', [
            'default_value' => 'StatsSections',
            'readonly' => 1,
            'wrapper' => ['class' => 'hidden'],
        ]);

        $block
            ->addTab('Content');

        (new Heading2())->build($block);
        (new Content())->build($block);
        (new ButtonsRepeater())->build($block);

        $block
            ->addTab('Stats');

        $block->addRepeater('stats', [
            'label' => 'Stats',
            'layout' => 'block',
            'wrapper' => [
                'width' => '50%',
            ],
            'button_label' => 'Add Stat',
        ])
            ->addText('title', [
                'label' => 'Title',
                'wrapper' => [
                    'width' => '50%',
                ],
            ])
            ->addText('value', [
                'label' => 'Value',
                'required' => 1,
                'wrapper' => [
                    'width' => '50%',
                ],
            ]);

        (new Background())->build($block);

        return $block;
    }
}
