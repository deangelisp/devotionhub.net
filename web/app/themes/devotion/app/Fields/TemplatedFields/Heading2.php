<?php

namespace App\Fields\TemplatedFields;

class Heading2
{
    public function build($builder)
    {

        return $builder
            ->addText('uppertitle', [
                'label' => 'UpperTitle',
                'wrapper' => [
                    'class' => 'acf-groupping-top field-horizontal',
                ],
            ])
            ->addText('title', [
                'label' => 'Title',
                'wrapper' => [
                    'class' => 'acf-groupping-bottom field-horizontal',
                ],
            ]);
    }
}
