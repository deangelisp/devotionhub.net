<?php

use App\Fields\Blocks\BaseBlock;
use App\Fields\TemplatedFields\Content;
use StoutLogic\AcfBuilder\FieldsBuilder;

class HeaderSearch extends BaseBlock
{
    protected $name = 'header_search';
    protected $category = 'hero_header_sections';

    public function defineFields()
    {
        $block = new FieldsBuilder($this->name, [
            'title' => 'Header Search',
            'display' => 'block',
        ]);

        // DON'T REMOVE THIS
        $block->addText('block_category_name', [
            'default_value' => 'HeroHeaderSections',
            'readonly' => 1,
            'wrapper' => ['class' => 'hidden'],
        ]);

        (new Content())->build($block);

        return $block;
    }
}
