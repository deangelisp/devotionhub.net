<?php

namespace App\View\Components\blocks\ContactSections;

use Illuminate\View\Component;

class ContactInfoAndForm extends Component
{

    public $forminatorFormId;

    public function __construct(
        $id = false,
        $block = false
    ) {
        $this->id = $id;
        $this->forminatorFormId = $block['forminator_form'];
        $this->uppertitle = $block['uppertitle'];
        $this->title = $block['title'];
        $this->content = $block['content'];

        $this->address = get_field('settings_general_address', 'option');
        $this->phone = get_field('settings_general_phone_number', 'option');
        $this->email = get_field('settings_general_email', 'option');
    }

    public function render()
    {
        return view('components.blocks.contact-sections.contact-info-and-form', [
            'id' => $this->id,
            'uppertitle' => $this->uppertitle,
            'title' => $this->title,
            'content' => $this->content,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            'forminatorFormId' => $this->forminatorFormId,
        ]);
    }
}
