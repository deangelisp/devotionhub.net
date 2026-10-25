<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$builder = new FieldsBuilder('course_settings');

$builder
    ->setLocation('post_type', '==', 'course');

$builder
    ->addRepeater('lessons')
    ->addPostObject('lesson', [
        'label' => 'Lesson',
        'post_type' => ['lesson'],
        'return_format' => 'id',
    ]);

return $builder;
