<?php

namespace App\Fields\TemplatedFields;

class FaqList
{
    public function build($builder)
    {
        $builder
            ->addRepeater('faq_list', [
                'label' => 'FAQ List',
                'layout' => 'block',
                'button_label' => 'Add FAQ',
                'collapsed' => 'heading',
            ])
            ->addText('heading', [
                'label' => 'Question',
                'required' => 1,
            ])
            ->addWysiwyg('body', [
                'label' => 'Answer',
                'required' => 1,
            ])
            ->endRepeater();

        return $builder;
    }
}
