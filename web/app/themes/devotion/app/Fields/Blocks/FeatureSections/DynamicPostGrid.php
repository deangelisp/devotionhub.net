<?php

use App\Fields\Blocks\BaseBlock;
use App\Fields\TemplatedFields\ButtonsRepeater;
use App\Fields\TemplatedFields\Content;
use App\Fields\TemplatedFields\Heading2;
use App\Fields\TemplatedFields\PostOptions;
use StoutLogic\AcfBuilder\FieldsBuilder;

class DynamicPostGrid extends BaseBlock
{
    protected $name = 'dynamic_post_grid';
    protected $category = 'feature_sections';

    public function defineFields()
    {
        $block = new FieldsBuilder($this->name, [
            'title' => 'Dynamic Post Grid',
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

        (new PostOptions())->build($block);

        return $block;
    }
}
