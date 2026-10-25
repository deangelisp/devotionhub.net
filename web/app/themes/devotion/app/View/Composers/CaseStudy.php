<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class CaseStudy extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var string[]
     */
    protected static $views = [
    ];

    public function with()
    {
        return [
        ];
    }

    private function relatedCaseStudies()
    {
    }
}
