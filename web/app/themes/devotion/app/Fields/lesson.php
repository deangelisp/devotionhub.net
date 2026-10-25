<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$builder = new FieldsBuilder('lesson_settings');

$builder
    ->setLocation('post_type', '==', 'lesson')
    ->addText('subject', [
        'label' => 'Email Subject',
    ]);

return $builder;
