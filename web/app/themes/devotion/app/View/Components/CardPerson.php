<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CardPerson extends Component
{

    public $id;
    public $thumbnail;
    public $name;
    public $role;
    public $department;
    public $email;
    public $phone;
    public $description;
    public $socialMedias;

    public function __construct($id = false)
    {
        $this->id = $id;

        $this->thumbnail = getTheThumbnail($id, 'thumbnail');
        $this->name = get_the_title($id);
        $this->role = get_field('role', $id);
        $this->department = get_field('department', $id);

        if ($this->department) {
            $term = get_term_by('slug', $this->department, 'department');

            if (isset($term->name)) {
                $this->department = $term->name;
            }
        }

        $this->email = get_field('email', $id);
        $this->phone = get_field('phone', $id);
        $this->description = get_field('description', $id);
        $this->socialMedias = get_field('social_medias', $id);
    }

    public function render()
    {
        return view('components.card-person');
    }

}
