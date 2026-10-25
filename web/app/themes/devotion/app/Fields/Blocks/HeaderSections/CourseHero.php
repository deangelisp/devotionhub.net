<?php

use App\Fields\Blocks\BaseBlock;
use App\Fields\TemplatedFields\Content;
use App\Fields\TemplatedFields\FieldsMessages;
use App\Fields\TemplatedFields\Heading2;
use StoutLogic\AcfBuilder\FieldsBuilder;

class CourseHero extends BaseBlock
{
    protected $name = 'course_hero';
    protected $category = 'header_sections';

    public function defineFields()
    {
        $fieldsMessages = new FieldsMessages();

        $block = new FieldsBuilder($this->name, [
            'title' => 'Course Hero',
            'display' => 'block',
        ]);

        // DON'T REMOVE THIS
        $block->addText('block_category_name', [
            'default_value' => 'HeaderSections',
            'readonly' => 1,
            'wrapper' => ['class' => 'hidden'],
        ]);

        $block
            ->addTab('Content');

        (new Heading2())->build($block);

        $block->addText('subtitle', [
            'label' => 'Subtitle',
            'instructions' => 'A short line under the title, e.g. "From Genesis to Jesus, one day at a time".',
        ]);

        (new Content())->build($block);

        $block
            ->addLink('primary_button', [
                'label' => 'Main button',
                'instructions' => 'The sign-up button, e.g. "Join the 90-Day Journey" to the app\'s /register page.',
                'wrapper' => ['width' => '50'],
            ])
            ->addLink('secondary_button', [
                'label' => 'Second button',
                'instructions' => 'e.g. "Log in" to the app\'s /login page.',
                'wrapper' => ['width' => '50'],
            ])
            ->addText('note', [
                'label' => 'Note under the buttons',
            ]);

        $block
            ->addTab('Images')
            ->addImage('image', [
                'label' => 'Desktop screenshot',
                'required' => 0,
                'return_format' => 'id',
                'preview_size' => 'medium',
                'library' => 'all',
                'mime_types' => 'jpg, jpeg, png, webp',
                'instructions' => $fieldsMessages->imageInstructions('JPG, PNG or WEBP', '1MB', '2560x1600'),
                'wrapper' => ['width' => '50'],
            ])
            ->addImage('image_phone', [
                'label' => 'Phone screenshot',
                'required' => 0,
                'return_format' => 'id',
                'preview_size' => 'medium',
                'library' => 'all',
                'mime_types' => 'jpg, jpeg, png, webp',
                'instructions' => $fieldsMessages->imageInstructions('JPG, PNG or WEBP', '1MB', '1170x2532'),
                'wrapper' => ['width' => '50'],
            ]);

        return $block;
    }
}
