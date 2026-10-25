<?php

namespace App\Fields\TemplatedFields;

class ButtonsRepeater
{
    public function build($builder)
    {
        return $builder
            ->addRepeater('buttons', [
                'label' => 'Buttons',
                'required' => 0,
                'layout' => 'block',
                'button_label' => 'Add Button',
            ])
            ->addLink('link', [
                'label' => 'Link',
                'required' => 1,
                'wrapper' => [
                    'width' => '50',
                ],
            ])
            ->addSelect('style', [
                'label' => 'Style',
                'required' => 1,
                'choices' => [
                    'primary' => 'Primary',
                    'secondary' => 'Secondary',
                    'tertiary' => 'Tertiary',
                ],
                'wrapper' => [
                    'width' => '50',
                ],
            ])
            ->endRepeater();

    }
}
