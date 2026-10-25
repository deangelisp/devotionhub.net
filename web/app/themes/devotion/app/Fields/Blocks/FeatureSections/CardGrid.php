<?php

use App\Fields\Blocks\BaseBlock;
use App\Fields\TemplatedFields\ButtonsRepeater;
use App\Fields\TemplatedFields\Content;
use App\Fields\TemplatedFields\Heading2;
use StoutLogic\AcfBuilder\FieldsBuilder;

class CardGrid extends BaseBlock
{
    protected $name = 'card_grid';
    protected $category = 'feature_sections';

    public function defineFields()
    {
        $block = new FieldsBuilder($this->name, [
            'title' => 'Card Grid',
            'display' => 'block',
        ]);

        // DON'T REMOVE THIS
        $block->addText('block_category_name', [
            'default_value' => 'FeatureSections',
            'readonly' => 1,
            'wrapper' => ['class' => 'hidden'],
        ]);

        $block
            ->addTab('Content');

        (new Heading2())->build($block);
        (new Content())->build($block);
        (new ButtonsRepeater())->build($block);

        $block
            ->addTab('Cards')
            ->addSelect('columns', [
                'label' => 'Columns on desktop',
                'choices' => [
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                ],
                'default_value' => '3',
                'wrapper' => ['width' => '25'],
            ])
            ->addTrueFalse('numbered', [
                'label' => 'Number the cards',
                'ui' => 1,
                'wrapper' => ['width' => '25'],
            ])
            ->addTrueFalse('tinted', [
                'label' => 'Tinted background',
                'ui' => 1,
                'wrapper' => ['width' => '25'],
            ])
            ->addRepeater('cards', [
                'label' => 'Cards',
                'layout' => 'block',
                'button_label' => 'Add Card',
            ])
            ->addText('label', [
                'label' => 'Label',
                'instructions' => 'Small text above the title, e.g. "Days 1–8".',
                'wrapper' => ['width' => '30'],
            ])
            ->addText('title', [
                'label' => 'Title',
                'required' => 1,
                'wrapper' => ['width' => '70'],
            ])
            ->addTextarea('text', [
                'label' => 'Text',
                'rows' => 3,
                'new_lines' => '',
            ])
            ->endRepeater();

        return $block;
    }
}
