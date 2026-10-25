<?php

use App\Fields\Blocks\BaseBlock;
use StoutLogic\AcfBuilder\FieldsBuilder;

class HistoryTimeline extends BaseBlock
{
    protected $name = 'history_timeline';
    protected $category = 'timeline_sections';

    public function defineFields()
    {
        $block = new FieldsBuilder($this->name, [
            'title' => 'History Timeline',
            'display' => 'block',
        ]);

        // DON'T REMOVE THIS
        $block->addText('block_category_name', [
            'default_value' => 'TimelineSections',
            'readonly' => 1,
            'wrapper' => ['class' => 'hidden'],
        ]);

        return $block;
    }
}
