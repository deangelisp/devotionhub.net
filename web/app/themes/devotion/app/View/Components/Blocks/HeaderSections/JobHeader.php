<?php

namespace App\View\Components\blocks\HeaderSections;

use Illuminate\View\Component;

class JobHeader extends Component
{

    public $title;
    public $jobType;
    public $form;
    public $deadline;
    public $posted;
    public $formLinkButton;

    public function __construct(
        $title = false,
        $jobtype = false,
        $form = false,
        $deadline = false,
        $posted = false,
    ) {

        $this->title = $title;
        $this->jobType = $jobtype;
        $this->form = $form;
        $this->deadline = $deadline;
        $this->posted = $posted;
        $this->formLinkButton = ['url' => '#form-application', 'title' => "Apply Now", 'target' => ''];
    }

    public function render()
    {
        return view('components.blocks.header-sections.job-header');
    }
}
