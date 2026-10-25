<?php

namespace App\Fields\Blocks\Footer;

use App\Fields\TemplatedFields\FieldsMessages;

class Footer3
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

        // $builder->addRepeater('settings_footer_copyright_menu', [
        //     'label' => 'Copyright Menu',
        //     'wrapper' => ['width' => '35'],
        //     'button_label' => 'Add Menu Item',
        // ])
        //     ->addLink('link', ['label' => 'Link'])

        //     ->endRepeater();

        $builder->addRepeater('settings_footer_menu', [
            'label' => 'Menu',
        ])->addRepeater('menu_list', [
            'label' => 'Menu List',
        ])
            ->addTrueFalse('is_title', [
                'label' => 'Is Title?',
                'ui' => 1,
                'wrapper' => ['width' => '15'],
            ])

            ->addLink(
                'link', [
                    'label' => 'Link',
                    'required' => true,
                    'wrapper' => ['width' => '85'],
                ],
            )
            ->endRepeater();

        return $builder;
    }
}
