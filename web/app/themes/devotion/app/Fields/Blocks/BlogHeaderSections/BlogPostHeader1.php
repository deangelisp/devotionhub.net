<?php

use App\Fields\Blocks\BaseBlock;
use StoutLogic\AcfBuilder\FieldsBuilder;

class BlogPostHeader1 extends BaseBlock
{
    protected $name = 'blog_post_header_1';
    protected $category = 'blog_header_sections';

    public function defineFields()
    {
        $block = new FieldsBuilder($this->name, [
            'title' => 'Blog Post Header 1',
            'display' => 'block',
        ]);

        // DON'T REMOVE THIS
        $block->addText('block_category_name', [
            'default_value' => 'BlogHeaderSections',
            'readonly' => 1,
            'wrapper' => ['class' => 'hidden'],
        ]);

        $block->addText('heading', [
            'label' => 'Heading',
            'required' => 1,
        ]);

        return $block;
    }
}
