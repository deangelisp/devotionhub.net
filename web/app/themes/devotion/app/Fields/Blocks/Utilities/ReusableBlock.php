<?php

use App\Fields\Blocks\BaseBlock;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ReusableBlock extends BaseBlock
{
    protected $name = 'reusable_block';
    protected $category = 'utilities';

    public function defineFields()
    {

        if ((isset($_GET['post_type']) && $_GET['post_type'] == 'reusable_blocks') || (isset($_GET['post']) && get_post_type($_GET['post']) == 'reusable_blocks')) {
            return false;
        }

        $block = new FieldsBuilder($this->name, [
            'title' => 'Reusable Block',
            'display' => 'block',
        ]);

        $block->setLocation('post_type', '!=', 'reusable_blocks');

        // DON'T REMOVE THIS
        $block->addText('block_category_name', [
            'default_value' => 'Utilities',
            'readonly' => 1,
            'wrapper' => ['class' => 'hidden'],
        ]);

        $block->addPostObject('reusable_block', [
            'label' => 'Select Reusable Block',
            'post_type' => ['reusable_blocks'],
            'return_format' => 'id',
            'ui' => 1,
            'required' => 1,
            'instructions' => '<a target="_blank" href="/wp/wp-admin/edit.php?post_type=reusable-components">Add reusable block</a>.',
            'wrapper' => ['width' => '40'],
        ]);

        return $block;
    }
}
