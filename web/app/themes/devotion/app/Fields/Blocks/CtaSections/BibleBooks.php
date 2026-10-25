<?php

use App\Fields\Blocks\BaseBlock;
use App\Fields\TemplatedFields\Content;
use App\Fields\TemplatedFields\Heading2;
use StoutLogic\AcfBuilder\FieldsBuilder;

class BibleBooks extends BaseBlock
{
    protected $name = 'bible_books';
    protected $category = 'cta_sections';

    public function defineFields()
    {
        $block = new FieldsBuilder($this->name, [
            'title' => 'Bible Books',
            'display' => 'block',
        ]);

        // DON'T REMOVE THIS
        $block->addText('block_category_name', [
            'default_value' => 'CtaSections',
            'readonly' => 1,
            'wrapper' => ['class' => 'hidden'],
        ]);

        (new Heading2())->build($block);
        (new Content())->build($block);

        return $block;
    }
}
