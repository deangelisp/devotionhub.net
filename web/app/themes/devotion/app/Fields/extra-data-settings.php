<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$builder = new FieldsBuilder('extra_data_settings');

$builder
    ->setLocation('post_type', '==', 'extra_data')
    ->addText('keywords', [
        'label' => 'Keywords',
        'wrapper' => ['width' => '30'],
    ])
    ->addText('passage', [
        'label' => 'Passage',
        'wrapper' => ['width' => '30'],
    ]);

return $builder;
