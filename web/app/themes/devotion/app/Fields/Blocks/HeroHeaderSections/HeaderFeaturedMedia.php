<?php

use App\Fields\Blocks\BaseBlock;
use App\Fields\TemplatedFields\ButtonsRepeater;
use App\Fields\TemplatedFields\Content;
use App\Fields\TemplatedFields\Heading2;
use App\Fields\TemplatedFields\ImageTab;
use StoutLogic\AcfBuilder\FieldsBuilder;

class HeaderFeaturedMedia extends BaseBlock
{
    protected $name = 'header_featured_media';
    protected $category = 'hero_header_sections';

    public function defineFields()
    {
        $block = new FieldsBuilder($this->name, [
            'title' => 'Header: Featured Media',
            'display' => 'block',
        ]);

        // DON'T REMOVE THIS
        $block->addText('block_category_name', [
            'default_value' => 'HeroHeaderSections',
            'readonly' => 1,
            'wrapper' => ['class' => 'hidden'],
        ]);

        $block
            ->addTab('Content');

        // Adding fields to the builder
        (new Heading2())->build($block);
        (new Content())->build($block);
        (new ButtonsRepeater())->build($block);

        (new ImageTab())->build($block);

        return $block;
    }
}
