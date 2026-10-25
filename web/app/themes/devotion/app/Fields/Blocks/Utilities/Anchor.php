<?php

use App\Fields\Blocks\BaseBlock;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Anchor extends BaseBlock
{
    protected $name = 'anchor';
    protected $category = 'utilities';

    public function defineFields()
    {
        $block = new FieldsBuilder($this->name, [
            'title' => 'Anchor',
            'display' => 'block',
        ]);

        // DON'T REMOVE THIS
        $block->addText('block_category_name', [
            'default_value' => 'Utilities',
            'readonly' => 1,
            'wrapper' => ['class' => 'hidden'],
        ]);

        $block->addText('anchor', [
            'label' => 'Enter unique anchor name',
            'required' => 1,
            'instructions' => 'Enter a unique name to create an anchor link.',

            'wrapper' => ['width' => '25'],
        ]);

        $block->addMessage('anchor_link', 'anchor_link');

        return $block;
    }
}
