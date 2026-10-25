<?php

use App\Fields\Blocks\BaseBlock;
use App\Fields\TemplatedFields\Content;
use App\Fields\TemplatedFields\Heading2;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ContactInfoAndForm extends BaseBlock
{
    protected $name = 'contact_info_and_form';
    protected $category = 'contact_sections';

    public function defineFields()
    {
        $block = new FieldsBuilder($this->name, [
            'title' => 'Contact Info And Form',
            'display' => 'block',
        ]);

        // DON'T REMOVE THIS
        $block->addText('block_category_name', [
            'default_value' => 'ContactSections',
            'readonly' => 1,
            'wrapper' => ['class' => 'hidden'],
        ]);

        $block->addSelect('forminator_form',
            [
                'label' => 'Forminator Form',
                'wrapper' => [
                    'width' => '20',
                ],
                'choices' => ['' => 'Select a form'] + get_forminator_forms(),
            ]
        );

        $block
            ->addMessage('message_field', 'message', [
                'label' => 'Informantion Fields',
                'required' => 0,
                'wrapper' => [
                    'width' => '50',
                ],
                'message' => '<a href="/wp/wp-admin/admin.php?page=website-options#general" target="_blank">Click here to edit the contact information.</a>',
                'new_lines' => 'wpautop', // 'wpautop', 'br', '' no formatting
                'esc_html' => 0,
            ]);

        (new Heading2())->build($block);
        (new Content())->build($block);

        return $block;
    }
}
