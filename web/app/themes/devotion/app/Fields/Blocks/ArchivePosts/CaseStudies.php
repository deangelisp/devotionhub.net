<?php

use App\Fields\Blocks\BaseBlock;
use App\Fields\TemplatedFields\Content;
use StoutLogic\AcfBuilder\FieldsBuilder;

class CaseStudies extends BaseBlock
{
    protected $name = 'case_studies';
    protected $category = 'archive_posts';
    public $pageDisplay = 'page_for_case_study';

    public function defineFields()
    {
        $block = new FieldsBuilder($this->name, [
            'title' => '<span class="dashicons dashicons-star-filled"></span>Case Studies',
            'display' => 'block',
        ]);

        // DON'T REMOVE THIS
        $block->addText('block_category_name', [
            'default_value' => 'ArchivePosts',
            'readonly' => 1,
            'wrapper' => ['class' => 'hidden'],
        ]);

        (new Content())->build($block);

        return $block;
    }
}
