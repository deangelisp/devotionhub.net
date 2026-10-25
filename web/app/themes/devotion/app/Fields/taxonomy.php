<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$builder = new FieldsBuilder('taxonomy_settings', [
    'label' => 'Content',
]);

$builder
// all taxonomies
    ->setLocation('taxonomy', '==', 'all')
    ->addWysiwyg('taxonomy_description', [
        'label' => 'Long Description',
        'required' => 0,
        'attachment' => 0,
    ]);

return $builder;
