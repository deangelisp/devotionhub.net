<?php

namespace App\Fields\TemplatedFields;

class Content
{
    public function build($builder)
    {
        return $builder
            ->addWysiwyg('content', [
                'label' => 'Content',
                'required' => 0,
            ]);
    }
}
