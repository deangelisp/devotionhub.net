<?php

use App\Fields\Blocks\BaseBlock;
use App\Fields\TemplatedFields\Background;
use App\Fields\TemplatedFields\ButtonsRepeater;
use App\Fields\TemplatedFields\Content;
use App\Fields\TemplatedFields\Heading2;
use StoutLogic\AcfBuilder\FieldsBuilder;

class CallToAction extends BaseBlock
{
    protected $name = 'call_to_action';
    protected $category = 'cta_sections';

    public function defineFields()
    {

        $imagePath = get_template_directory_uri() . '/resources/images/admin/AcfAssets/';

        $block = new FieldsBuilder($this->name, [
            'title' => 'Call to Action',
            'display' => 'block',
        ]);

        // DON'T REMOVE THIS
        $block->addText('block_category_name', [
            'default_value' => 'CtaSections',
            'readonly' => 1,
            'wrapper' => ['class' => 'hidden'],
        ]);

        $block
            ->addTab('Content');

        (new Heading2())->build($block);
        (new Content())->build($block);
        (new ButtonsRepeater())->build($block);

        (new Background())->build($block);

        $block
            ->addButtonGroup('style',
                [
                    'label' => 'Style',
                    'choices' => [
                        'normal' => 'Normal',
                        'card' => 'Card',
                    ],
                    'default_value' => 'normal',
                    'wrapper' => [
                        'width' => '25',
                    ],
                ]
            );

        $block
            ->addMessage('example_call_to_action_normal',
                '<img src="' . $imagePath . '/call-to-action-normal.png" alt="Placeholder Image" class="acf-fc-layout-preview-thumb" style="width: 100%;">'
                , [
                    'label' => 'Normal Width Images Example',
                    'wrapper' => [
                        'width' => '25',
                    ],
                ])
            ->conditional('style', '==', 'normal');

        $block
            ->addMessage('example_call_to_action_card', '<img src="' . $imagePath . '/call-to-action-card.png" class="acf-fc-layout-preview-thumb" alt="Placeholder Image" style="width: 100%;">',
                [
                    'label' => 'Card Width Images Example',
                    'wrapper' => [
                        'width' => '25',
                    ],
                ])
            ->conditional('style', '==', 'card');

        return $block;
    }
}
