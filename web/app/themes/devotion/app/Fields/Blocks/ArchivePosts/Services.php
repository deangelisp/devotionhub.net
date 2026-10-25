<?php

use App\Fields\Blocks\BaseBlock;
use App\Fields\TemplatedFields\Content;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Services extends BaseBlock
{
    protected $name = 'services';
    protected $category = 'archive_posts';
    public $pageDisplay = 'page_for_service';

    public function defineFields()
    {
        $block = new FieldsBuilder($this->name, [
            'title' => '<span class="dashicons dashicons-star-filled"></span> Services',
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
