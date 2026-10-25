<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$builder = new FieldsBuilder('post_settings', ['position' => 'side']);

$builder
    ->setLocation('post_type', '==', 'post')
    ->addText('reading_time', [
        'label' => 'Reading Time',
        'append' => 'minutes',
        'wrapper' => ['width' => '50'],
    ])
    ->addTextarea('summary', [
        'label' => 'Summary',
        'rows' => 2,
        'wrapper' => ['width' => '50'],
    ]);

return $builder;
