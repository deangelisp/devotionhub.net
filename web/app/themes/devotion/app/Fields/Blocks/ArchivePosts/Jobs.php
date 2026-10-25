<?php

use App\Fields\Blocks\BaseBlock;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Jobs extends BaseBlock
{
    protected $name = 'jobs';
    protected $category = 'archive_posts';
    public $pageDisplay = 'page_for_jobs';

    public function defineFields()
    {
        $block = new FieldsBuilder($this->name, [
            'title' => '<span class="dashicons dashicons-star-filled"></span>Jobs',
            'display' => 'block',
        ]);

        // DON'T REMOVE THIS
        $block->addText('block_category_name', [
            'default_value' => 'ArchivePosts',
            'readonly' => 1,
            'wrapper' => ['class' => 'hidden'],
        ]);

        $block
            ->addWysiwyg('not_posts_found_message', [
                'label' => 'Message to display when no jobs are found',
            ]);

        return $block;
    }
}
