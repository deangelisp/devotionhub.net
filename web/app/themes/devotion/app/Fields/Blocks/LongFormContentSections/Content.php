<?php

use App\Fields\Blocks\BaseBlock;
use App\Fields\TemplatedFields\Content as TemplatedContent;
use App\Fields\TemplatedFields\Heading2;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Content extends BaseBlock
{
    protected $name = 'content';
    protected $category = 'long_form_content_sections';

    public function defineFields()
    {
        $block = new FieldsBuilder($this->name, [
            'title' => 'Content',
            'display' => 'block',
        ]);

        $imagePath = get_template_directory_uri() . '/resources/images/admin/AcfAssets/';

        // DON'T REMOVE THIS
        $block->addText('block_category_name', [
            'default_value' => 'LongFormContentSections',
            'readonly' => 1,
            'wrapper' => ['class' => 'hidden'],
        ]);

        $block
            ->addTab('Content');

        (new Heading2())->build($block);
        (new TemplatedContent())->build($block);

        $block
            ->addTab('Options');

        // Add a option of content width
        $block
            ->addSelect('content_width', [
                'label' => 'Content Width',
                'choices' => [
                    'full' => 'Full Width',
                    'narrow' => 'Narrow Width',
                ],
                'default_value' => 'narrow',
                'wrapper' => [
                    'width' => '25',
                ],
            ]);

        // add a option to check if images should be full width
        $block
            ->addTrueFalse('full_width_images', [
                'label' => 'Full Width Images',
                'default_value' => 1,
                'ui' => 1,
                'wrapper' => [
                    'width' => '25',
                ],
            ])
            ->conditional('content_width', '==', 'narrow');

        $block
            ->addMessage('example_full_width_images',
                '<img src="' . $imagePath . '/content-block-full-image.png" alt="Placeholder Image" class="acf-fc-layout-preview-thumb" style="width: 100%;">'
                , [
                    'label' => 'Full Width Images Example',
                    'wrapper' => [
                        'width' => '25',
                    ],
                ])
            ->conditional('content_width', '==', 'narrow')
            ->and('full_width_images', '==', 1);

        $block
            ->addMessage('example_narrow_width_images', '<img src="' . $imagePath . '/content-block-narrow-image.png" class="acf-fc-layout-preview-thumb" alt="Placeholder Image" style="width: 100%;">',
                [
                    'label' => 'Narrow Width Images Example',
                    'wrapper' => [
                        'width' => '25',
                    ],
                ])
            ->conditional('content_width', '==', 'narrow')
            ->and('full_width_images', '!=', 1);

        return $block;

    }
}
