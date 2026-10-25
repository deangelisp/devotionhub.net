<?php
use App\Fields\TemplatedFields\FieldsMessages;
use StoutLogic\AcfBuilder\FieldsBuilder;

$fieldsMessages = new FieldsMessages();

// Create a new FieldsBuilder instance for the group
$builder = new FieldsBuilder('website_options');
$builder
    ->setLocation('options_page', '==', 'website-options');

$generalTab = $builder->addTab('general',
    [
        'label' => 'General',
        'placement' => 'left',
    ]
);

$generalTab
    ->addImage('settings_general_logo', [
        'label' => 'Logo',
        'return_format' => 'id',
        'library' => 'all',
        'mime_types' => 'jpg, jpeg, png, webp',
        'instructions' => $fieldsMessages->imageInstructions('jpg, png, webp', '500KB', '400x400'),
        'wrapper' => ['width' => '30'],
    ])

    ->addMessage('settings_breakline', '', [
        'wrapper' => [
            'class' => 'acf-breakline',
        ],
    ])
    ->addText('settings_general_phone_number', [
        'label' => 'Phone number',
        'wrapper' => ['width' => '30'],
    ])
    ->addText('settings_general_email', [
        'label' => 'Email',
        'wrapper' => ['width' => '30'],
    ])
    ->addTextArea('settings_general_address', [
        'label' => 'Address',
        'rows' => 2,
        'wrapper' => ['width' => '40'],
    ])
    ->addRepeater('settings_general_social_medias', [
        'label' => 'Social Medias',
        'wrapper' => ['width' => '30'],
    ])
    ->addUrl('url', ['label' => 'URL'])
    ->endRepeater()
    ->addImage('settings_general_default_thumbnail', [
        'label' => 'Default thumbnail',
        'return_format' => 'id',
        'library' => 'all',
        'mime_types' => 'jpg, jpeg, png, webp',
        'instructions' => $fieldsMessages->imageInstructions('JPG, PNG or WEBP', '2MB', '1920x1080'),
        'wrapper' => ['width' => '30'],
        'required' => true,
    ]);

$headerTab = $builder->addTab('header',
    [
        'label' => 'Header',
        'placement' => 'left',
    ]);

$headerTab->addLink('settings_header_cta',
    [
        'label' => 'Call to action',
        'return_format' => 'array',
        'wrapper' => ['width' => '30'],
    ])
    ->addWysiwyg('settings_header_spotlight',
        [
            'label' => 'Header Spotlight Bar',
            'media_upload' => 0,
        ]);

$footerTab = $builder->addTab('footer',
    [
        'label' => 'Footer',
        'placement' => 'left',
    ]);

$footerClassName = get_field('settings_footer', 'option');
$footerClassName = 'App\Fields\Blocks\Footer\\' . $footerClassName;

(new $footerClassName)->build($footerTab);

$EmailTab = $builder->addTab('Email',
    [
        'label' => 'Email',
        'placement' => 'left',
    ]);

$EmailTab
    ->addGroup(
        'settings_email_mandrill',
        [
            'label' => 'Mandrill',
            'instructions' => '<a href="https://mandrillapp.com/" target="_blank">Click to create your API Key.</a>',
        ])
    ->addText('api_key',
        [
            'label' => 'API Key',
            'wrapper' => ['width' => '30'],
        ])
    ->addText('sender_name',
        [
            'label' => 'Sender name',
            'wrapper' => ['width' => '30'],
        ])
    ->addText('sender_email_address',
        [
            'label' => 'Sender email address',
            'wrapper' => ['width' => '40'],
        ]
    )
    ->endGroup()
    ->addAccordion('Email Template')
    ->addMessage('', 'In this section, you have the flexibility to personalize your website emails. <a href="/wp/wp-admin/themes.php?page=preview-email" target="_blank">Click here to preview your email template</a>')

    ->addGroup('settings_email_template_colors', ['label' => 'Colors'])
    ->addColorPicker('features',
        [
            'label' => 'Features',
            'default_value' => '#4d1254',
            'wrapper' => ['width' => '25'],
        ])
    ->addColorPicker('background',
        [
            'label' => 'Background',
            'default_value' => '#f1f5ff',
            'wrapper' => ['width' => '25'],
        ])
    ->addColorPicker('footer_background',
        [
            'label' => 'Footer Background',
            'default_value' => '#16191e',
            'wrapper' => ['width' => '25'],
        ])
    ->addColorPicker('footer_text',
        [
            'label' => 'Footer Text',
            'default_value' => '#8b8c8f',
            'wrapper' => ['width' => '25'],
        ])
    ->endGroup()

    ->addGroup('settings_email_template_footer', ['label' => 'Footer'])
    ->addImage('logo', [
        'label' => 'Logo',
        'library' => 'all',
        'mime_types' => 'jpg, jpeg, png, webp',
        'instructions' => $fieldsMessages->imageInstructions('jpg, png, webp', '500KB', '400x400'),
        'return_format' => 'id',
        'wrapper' => ['width' => '33'],
    ])
    ->addMessage('message_phone_number', '<a href="/wp/wp-admin/admin.php?page=website-options#general">Click Here to edit the phone number</a>',
        [
            'label' => 'Phone Number',
            'wrapper' => ['width' => '33'],
        ])
    ->addMessage('message_social_medias', '<a href="/wp/wp-admin/admin.php?page=website-options#general">Click here to edit social media</a>',
        [
            'label' => 'Social Medias',
            'wrapper' => ['width' => '33'],
        ])
    ->addRepeater('links', [
        'label' => 'Links',
        'wrapper' => ['width' => '33'],
    ])
    ->addLink('link', ['label' => 'Link'])
    ->endRepeater()
    ->addTextarea('message',
        [
            'label' => 'Message',
            'rows' => 8,
            'wrapper' => ['width' => '67'],
        ])
    ->endGroup()
    ->addAccordion('accordion_field_end')->endpoint();

$seoTab = $builder->addTab('seo',
    [
        'label' => 'SEO',
        'placement' => 'left',
    ]);

$seoTab
    ->addText('settings_seo_google_tag_manager', [
        'label' => 'Google Tag Manager',
        'wrapper' => ['width' => '33'],
        'placeholder' => 'GTM-XXXXXXX',
        'instructions' => '<a href="https://tagmanager.google.com/" target="_blank">Click to create your Google Tag Manager ID.</a>',
    ]);

// Build the ACF fields
return $builder;
