<?php

use App\Fields\Blocks\BaseBlock;
use App\Fields\TemplatedFields\Content;
use App\Fields\TemplatedFields\FaqList;
use App\Fields\TemplatedFields\Heading2;
use StoutLogic\AcfBuilder\FieldsBuilder;

class FaqAccordionList extends BaseBlock
{
    protected $name = 'faq_accordion_list';
    protected $category = 'faq_sections';

    public function defineFields()
    {
        $block = new FieldsBuilder($this->name, [
            'title' => 'FAQ Accordion List',
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

        (new FaqList())->build($block);

        $block
            ->addTab('Footer');

        $block
            ->addWysiwyg('footer_content', [
                'label' => 'Footer Content',
                'media_upload' => 0,
            ]);

        return $block;
    }
}
