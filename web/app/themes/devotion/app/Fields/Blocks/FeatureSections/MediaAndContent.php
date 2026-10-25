<?php

use App\Fields\Blocks\BaseBlock;
use App\Fields\TemplatedFields\ButtonsRepeater;
use App\Fields\TemplatedFields\Content;
use App\Fields\TemplatedFields\Heading2;
use App\Fields\TemplatedFields\ImageTab;
use App\Fields\TemplatedFields\ListOfItems;
use StoutLogic\AcfBuilder\FieldsBuilder;

class MediaAndContent extends BaseBlock
{
    protected $name = 'media_and_content';
    protected $category = 'feature_sections';

    public function defineFields()
    {
        $block = new FieldsBuilder($this->name, [
            'title' => 'Media and Content',
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

        // Adding fields to the builder
        (new Heading2())->build($block);
        (new Content())->build($block);
        (new ButtonsRepeater())->build($block);

        (new ImageTab())->build($block, true, false);

        (new ListOfItems())->build($block);

        return $block;
    }
}
