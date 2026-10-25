<?php

use App\Fields\Blocks\BaseBlock;
use App\Fields\TemplatedFields\Content;
use App\Fields\TemplatedFields\Heading2;
use App\Fields\TemplatedFields\ImageTab;
use StoutLogic\AcfBuilder\FieldsBuilder;

class LadingPageHeader extends BaseBlock
{
    protected $name = 'lading_page_header';
    protected $category = 'header_sections';

    public function defineFields()
    {
        $block = new FieldsBuilder($this->name, [
            'title' => 'Lading Page Header',
            'display' => 'block',
        ]);

        // DON'T REMOVE THIS
        $block->addText('block_category_name', [
            'default_value' => 'HeaderSections',
            'readonly' => 1,
            'wrapper' => ['class' => 'hidden'],
        ]);
        $block
            ->addTab('Content');

        (new Heading2())->build($block);
        (new Content())->build($block);
        (new ImageTab())->build($block, true, false);

        return $block;
    }
}
