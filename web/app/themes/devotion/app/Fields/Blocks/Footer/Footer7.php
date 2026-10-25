<?php

namespace App\Fields\Blocks\Footer;

use App\Fields\TemplatedFields\FieldsMessages;

class Footer7
{

    public function build($builder)
    {
        $fieldsMessages = new FieldsMessages();

        $builder->addImage('settings_footer_logo', [
            'label' => 'Logo',
            'return_format' => 'id',
            'library' => 'all',
            'mime_types' => 'jpg, jpeg, png, webp',
            'instructions' => $fieldsMessages->imageInstructions('jpg, png, webp', '500KB', '400x400'),
            'wrapper' => ['width' => '30'],
        ]);

        $builder->addRepeater('settings_footer_simple_menu', [
            'label' => 'Menu',
            'wrapper' => ['width' => '35'],
            'button_label' => 'Add Menu Item',
        ])
            ->addLink('link', ['label' => 'Link'])

            ->endRepeater();

        return $builder;
    }
}
